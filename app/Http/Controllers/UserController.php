<?php

namespace App\Http\Controllers;

use App\Data\User\UserCreateData;
use App\Http\Resource\UserResource;
use App\Services\UserService;

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
}
