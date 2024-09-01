<?php

namespace App\Http\Services;

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
}
