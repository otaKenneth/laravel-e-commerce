<?php

namespace App\Services;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class FileStorageService
{
    /**
     * Store the file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $path
     * @return string|false
     */
    public function storeFile(UploadedFile $file, $path, $size = false)
    {
        if (config('app.env') === 'development') {
            // Store the file locally
            return $this->storeLocally($file, $path, $size);
        } else {
            // Store the file in Google Cloud Storage
            return $this->storeInGCS($file, $path, $size);
        }
    }

    public function storeVideo(UploadedFile $file, $path, $name) {
        if (config('app.env') === 'development') {
            // Store the file locally
            return $this->storeVideoLocally($file, $path, $name);
        } else {
            // Store the file in Google Cloud Storage
            $path = $path . $name;
            return $this->storeVideoInGCS($file, $path);
        }
    }

    /**
     * Store the file locally.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $path
     * @return string|false
     */
    protected function storeLocally(UploadedFile $file, $path, $size = false)
    {
        $file = Image::make($file);
        if ($size) {
            $file = $file->resize($size['width'], $size['height']);
        }

        return $file->save($path);
    }

    protected function storeVideoLocally(UploadedFile $file, $path, $name)
    {
        $file->move($path, $name);
        return $file->save($path);
    }

    /**
     * Store the file in Google Cloud Storage.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $path
     * @return string|false
     */
    protected function storeInGCS(UploadedFile $file, $path, $size = false)
    {
        $gcsConfig = config('filesystems.disks.gcs_admin');

        // Create a StorageClient instance using the configuration
        $storage = new StorageClient([
            'projectId' => $gcsConfig['project_id'],
            'keyFilePath' => $gcsConfig['key_file']
        ]);

        // Specify your bucket name from the configuration
        $bucketName = $gcsConfig['bucket'];
        $bucket = $storage->bucket($bucketName);

        try {
            $file = Image::make($file);
            if ($size) {
                $file = $file->resize($size['width'], $size['height']);
            }
            $file_content = $file->encode()->__tostring();
            $success = $bucket->upload($file_content, [
                'name' => $path
            ]);
            
            if (!$success) return false;
            
            return true;
        } catch (\Exception $e) {
            // Log any exceptions that occur during the process
            \Log::error("Exception occurred while uploading file to GCS. Path: {$path}, Error: {$e->getMessage()}");
            return false;
        }
    }

    protected function storeVideoInGCS(UploadedFile $file, $path)
    {
        $gcsConfig = config('filesystems.disks.gcs_admin');

        // Create a StorageClient instance using the configuration
        $storage = new StorageClient([
            'projectId' => $gcsConfig['project_id'],
            'keyFilePath' => $gcsConfig['key_file']
        ]);

        // Specify your bucket name from the configuration
        $bucketName = $gcsConfig['bucket'];
        $bucket = $storage->bucket($bucketName);

        try {
            $file_content = $file->encode()->__toString();
            $success = $bucket->upload($file_content, [
                'name' => $path
            ]);

            if (!$success) return false;
            
            return true;
        } catch (\Exception $e) {
            // Log any exceptions that occur during the process
            \Log::error("Exception occurred while uploading file to GCS. Path: {$path}, Error: {$e->getMessage()}");
            return false;
        }
    }
}
