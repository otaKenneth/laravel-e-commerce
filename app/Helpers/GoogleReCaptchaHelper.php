<?php
namespace App\Helpers;

// Include Google Cloud dependencies using Composer
use Google\Cloud\RecaptchaEnterprise\V1\Client\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;
use Google\Cloud\RecaptchaEnterprise\V1\CreateAssessmentRequest;

class GoogleReCaptchaHelper
{
    /**
      * Create an assessment to analyze the risk of a UI action.
      * @param string $recaptchaKey The reCAPTCHA key associated with the site/app
      * @param string $token The generated token obtained from the client.
      * @param string $project Your Google Cloud Project ID.
      * @param string $action Action name corresponding to the token.
      */
    public function create_assessment(
        string $recaptchaKey,
        string $token,
        string $project,
        string $action
    ) {
        // Create the reCAPTCHA client.
        // TODO: Cache the client generation code (recommended) or call client.close() before exiting the method.
        $client = new RecaptchaEnterpriseServiceClient([
            'credentials' => $recaptchaKey
        ]);
        $projectName = RecaptchaEnterpriseServiceClient::projectName($project);

        // Set the properties of the event to be tracked.
        $event = (new Event())
            ->setSiteKey("6Lc8YjErAAAAAI4c_4rpCJVI0VjevDquLHmRe17X")
            ->setToken($token);

        // Build the assessment request.
        $assessment = (new Assessment())
            ->setEvent($event);

        $request = (new CreateAssessmentRequest())
            ->setParent($projectName)
            ->setAssessment($assessment);

        try {
            $response = $client->createAssessment(
                $request
            );

            // Check if the token is valid.
            if ($response->getTokenProperties()->getValid() == false) {
                throw new \Exception('The CreateAssessment() call failed because the token was invalid for the following reason: ' . InvalidReason::name($response->getTokenProperties()->getInvalidReason()));
            }

            // Check if the expected action was executed.
            if ($response->getTokenProperties()->getAction() == $action) {
                // Get the risk score and the reason(s).
                // For more information on interpreting the assessment, see:
                // https://cloud.google.com/recaptcha-enterprise/docs/interpret-assessment
                return response()->json(['message' => "The score for the protection action is: " . $response->getRiskAnalysis()->getScore(), 'success' => true]);
            } else {
                throw new \Exception('The action attribute in your reCAPTCHA tag does not match the action you are expecting to score');
            }
        } catch (\Exception $e) {
            logger('CreateAssessment() call failed with the following error: '. $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 402);
        }
    }

    private function getSignedUrl($bucket, $objectName, $expiration = "+1 hour") {
        try {
            $object = $bucket->object($objectName);
            $signedUrl = $object->signedUrl(new \DateTime($expiration));
            // Log the signed URL for debugging
            return $signedUrl;
        } catch (\Exception $e) {
            \Log::error('Error generating signed URL for ' . $objectName . ': ' . $e->getMessage());
            return $bucket->object('front/images/product/no-available-image.jpg')->signedUrl(new \DateTime('+1 hour'));
        }
    }
}
