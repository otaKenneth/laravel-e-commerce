<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
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

    /**
     * Store the file in Google Cloud Storage.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $path
     * @return string|false
     */
    protected function storeInGCS(UploadedFile $file, $path, $size = false)
    {
        $file = Image::make($file);
        if ($size) {
            $file = $file->resize($size['width'], $size['height']);
        }
        $file = $file->encode();

        return Storage::disk('gcs_admin')->put($path, $file);
    }
}
