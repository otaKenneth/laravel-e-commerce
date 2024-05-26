<?php

namespace App\Providers;

use Google\Auth\CredentialsLoader;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Customizing The Pagination View Using Bootstrap (displaying Laravel pagination using Bootstrap pagination): https://laravel.com/docs/9.x/pagination#using-bootstrap
        \Illuminate\Pagination\Paginator::useBootstrap();

        // Retrieve the Google Cloud Storage configuration from the filesystems.php config file
        $gcsConfig = config('filesystems.disks.gcs');

        // Create a StorageClient instance using the configuration
        $storage = new StorageClient([
            'projectId' => $gcsConfig['project_id'],
            'keyFilePath' => $gcsConfig['key_file'],
            'credentials' => CredentialsLoader::makeCredentials(['https://www.googleapis.com/auth/cloud-platform'], json_decode(file_get_contents($gcsConfig['key_file']), true))
        ]);

        // Specify your bucket name from the configuration
        $bucketName = $gcsConfig['bucket'];
        $bucket = $storage->bucket($bucketName);

        // Define the default image URL
        $defaultImagePath = 'front/images/product/no-available-image.jpg';
        try {
            $defaultImageUrl = $bucket->object($defaultImagePath)->signedUrl(new \DateTime('+1 hour'));
            // Log the signed URL for debugging
            \Log::info('Default Image Signed URL: ' . $defaultImageUrl);
        } catch (\Exception $e) {
            \Log::error('Error generating signed URL: ' . $e->getMessage());
        }

        // Share the storage instance and bucket name with all views
        view()->share([
            'defaultImage' => $defaultImageUrl,
            'getSignedUrl' => function ($objectName, $expiration = '+1 hour') use ($bucket) {
                return $this->getSignedUrl($bucket, $objectName, $expiration);
            },
            'getImage' => function ($filepath, $imageName) use ($bucket) {
                if (env('APP_ENV') == "development") {
                    if (!empty($imageName) && file_exists($filepath . $imageName)) {
                        return asset($filepath . $imageName);
                    } else {
                        return asset('front/images/product/no-available-image.jpg');
                    }
                } else {
                    return $this->getSignedUrl($bucket, $filepath . $imageName, '+1 hour');
                }
            }
        ]);
    }

    private function getSignedUrl($bucket, $objectName, $expiration = "+1 hour") {
        try {
            $object = $bucket->object($objectName);
            $signedUrl = $object->signedUrl(new \DateTime($expiration));
            // Log the signed URL for debugging
            \Log::info('Signed URL for ' . $objectName . ': ' . $signedUrl);
            return $signedUrl;
        } catch (\Exception $e) {
            \Log::error('Error generating signed URL for ' . $objectName . ': ' . $e->getMessage());
            return $bucket->object('front/images/product/no-available-image.jpg')->signedUrl(new \DateTime('+1 hour'));;
        }
    }
}