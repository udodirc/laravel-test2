<?php

namespace App\Services;

use App\Data\User\UserCreateData;
use App\Http\Repositories\UserRepository;
use App\Models\User;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function create(UserCreateData $data): User
    {
        return $this->userRepository->create($data);
    }
}
