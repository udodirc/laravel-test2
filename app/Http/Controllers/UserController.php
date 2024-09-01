<?php

namespace App\Http\Controllers;

use App\Data\User\UserCreateData;
use App\Http\Resource\UserResource;
use App\Http\Services\FileService;
use App\Services\UserService;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function store(UserCreateData $data): UserResource
    {
        return new UserResource(
            $this->userService->create($data)
        );
    }

    public function import()
    {
        if (Storage::exists('public/users/import.csv')) {
            $filePath = storage_path('app/public/users/import.csv');
            $data = FileService::parseCsv($filePath);
            dd($data);
        }
    }
}
