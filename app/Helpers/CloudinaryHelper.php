<?php

namespace App\Helpers;
use Cloudinary\Cloudinary;

class CloudinaryHelper 
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            "cloud" => [
                "cloud_name" => env("cloudinary.CLOUD_NAME"),
                "api_key" => env("cloudinary.API_KEY"),
                "api_secret" => env("cloudinary.API_SECRET")
            ]
        ]);
    }

    public function upload($imageFile)
    {
        $dataUri = "data:image/jpeg;base64," . $imageFile;
        return $this
                    ->cloudinary
                    ->uploadApi()
                    ->upload($dataUri, [
                        "verify_ssl" => false
                    ]);
                    
    }

}