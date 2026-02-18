<?php

namespace App\Helpers;

use Exception;
class ImageHelper
{
    public function generateFileName($imageFile)
    {
        $image = str_replace("data:image/png;base64,", '', $imageFile);
        $image = str_replace(" ", "+", $image);

        $imageData = base64_decode($image);
        $fileName = $this->createFileName($imageData);
        $filePath = FCPATH . "uploads/" . $fileName;

        $writeImageIntoDir = file_put_contents($filePath, $imageData);
        if ($writeImageIntoDir) {
            throw new Exception("Unable to write the image into the dir");
        }

        return $fileName;
    }

    private function uploadImgIntoDir($filePath, $imageData)
    {
        return file_put_contents($filePath, $imageData);
    }

    private function createFileName($imageData)
    {
        return uniqid($imageData) . "png";
    }
}