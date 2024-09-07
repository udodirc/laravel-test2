<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FileService
{
    public static function parseCsv($filePath): array
    {
        $data = [];

        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle)) !== FALSE) {
                $data[] = $row;
            }
            fclose($handle);
        }

        return $data;
    }

    public static function resizeImage(UploadedFile $file, int $width, int $height): string
    {
        // Create an Intervention Image instance
        $image = Image::read($file);

        if($image){
            // Resize the image
            $image->resize($width, $height); // Resize to 300x300 pixels

            // Save the image to a specific location
            $path = time() . '.' . $file->getClientOriginalExtension();

            if($image->save(public_path('uploads/' . $path)))
            {
                return $path;
            }
        }

        throw new BadRequestHttpException('Cannot upload the file');
    }
}
