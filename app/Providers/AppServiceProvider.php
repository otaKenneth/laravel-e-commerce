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
        \Illuminate\Pagination\Paginator::useBootstrap();

        if (app()->runningInConsole()) {
            return; // Avoid running GCS logic during composer scripts and artisan commands like `package:discover`
        }

        $gcsConfig = config('filesystems.disks.gcs');

        if (!$gcsConfig || empty($gcsConfig['project_id']) || empty($gcsConfig['key_file']) || empty($gcsConfig['bucket'])) {
            \Log::warning('GCS config is incomplete or missing');
            return;
        }

        $storage = new StorageClient([
            'projectId' => $gcsConfig['project_id'],
            'keyFilePath' => $gcsConfig['key_file'],
        ]);

        $bucketName = $gcsConfig['bucket'];
        $bucket = $storage->bucket($bucketName);

        $defaultImagePath = 'front/images/product/no-available-image.jpg';
        try {
            $defaultImageUrl = $bucket->object($defaultImagePath)->signedUrl(new \DateTime('+1 hour'));
        } catch (\Exception $e) {
            \Log::error('Error generating signed URL: ' . $e->getMessage());
            $defaultImageUrl = asset($defaultImagePath);
        }

        view()->share([
            'defaultImage' => $defaultImageUrl,
            'getSignedUrl' => function ($objectName, $expiration = '+1 hour') use ($bucket) {
                return $this->getSignedUrl($bucket, $objectName, $expiration);
            },
            'getImage' => function ($filepath, $imageName) use ($bucket) {
                if (env('APP_ENV') === "development") {
                    if (!empty($imageName) && file_exists($filepath . $imageName)) {
                        return asset($filepath . $imageName);
                    } else {
                        return asset('front/images/product/no-available-image.jpg');
                    }
                } else {
                    if (empty($imageName)) {
                        return $bucket->object('front/images/product/no-available-image.jpg')->signedUrl(new \DateTime('+1 hour'));
                    } else {
                        return $this->getSignedUrl($bucket, $filepath . $imageName, '+1 hour');
                    }
                }
            }
        ]);
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