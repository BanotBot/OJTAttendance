
<?php

    class ImageHelper
    {
        public function generateFileName($imageFile)
        {
            $image = str_replace("data:image/png;base64,", '', $imageFile);
            $image = str_replace(" " , "+", $image);

            $imageData = base64_decode($image);
            $fileName = $this->createFileName($imageData);
            $filePath = FCPATH. "uploads/" . $fileName;

            file_put_contents($filePath, $fileName);

            return $fileName;
        }

        private function createFileName($imageData)
        {
            return uniqid($imageData) . "png";
        }
    }