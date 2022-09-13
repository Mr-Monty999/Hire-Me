<?php

namespace App\Services;


class FileUploadService

{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function uploadImage($image, $publicPath)
    {


        if (file_exists(public_path($publicPath)) && is_dir(public_path($publicPath))) {
            $newImageName = self::renameFileToTimeStamp($image);
            $fullImagePath = $publicPath . "/" . $newImageName;
            $image->move(public_path($publicPath), $newImageName);
            return $fullImagePath;
        }
    }

    public static function deleteImageIfExists($imagePath)
    {
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
            return true;
        }
        return false;
    }

    public static function renameFileToTimeStamp($image)
    {
        return time() . "." . $image->getClientOriginalExtension();
    }
}
