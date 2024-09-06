<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        // Validate the request to ensure a file is present
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Adjust validation rules as needed
            'width' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        // Handle the file upload
        $path = FileService::resizeImage($request->file('file'), $request->width, $request->height);

        // Return a response
        return response()->json([
            'message' => 'File uploaded successfully',
            'path' => $path,
        ], 201);
    }
}
