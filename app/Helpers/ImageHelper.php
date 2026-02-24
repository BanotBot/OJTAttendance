<?php

namespace App\Helpers;

use Cloudinary\Cloudinary;
use Exception;

class ImageHelper
{
    
    public function generateFileName($imageFile)
    {
        $image = str_replace("data:image/\w+;base64,#i", '', $imageFile);
        $image = str_replace(" ", "+", $image);

        $imageData = base64_decode($image);
        $fileName = $this->createFileName();
        $uploadDir = FCPATH . "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filePath = $uploadDir . $fileName;

        $writeImageIntoDir = $this->upload_img_to_dir($filePath, $imageData);
        if ($writeImageIntoDir === FALSE) {
            throw new Exception("Unable to write the image into the dir");
        }

        return $fileName;
    }

    private function upload_img_to_dir($filePath, $imageData)
    {
        return file_put_contents($filePath, $imageData);
    }

    private function createFileName()
    {
        return uniqid().".jpg";
    }
}