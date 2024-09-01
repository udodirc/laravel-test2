<?php

namespace App\Services;

use App\Data\User\UserCreateData;
use App\Models\User;
use Spatie\LaravelData\Optional;

class UserService
{
    public function create(UserCreateData $data): User
    {
        $user = new User();
        $user->email = $data->email;
        $user->password = $data->password;
        $user->name = $data->name;

        if (! $data->emailVerifiedAt instanceof Optional) {
            $user->email_verified_at = $data->emailVerifiedAt;
        }

        $user->save();

        return $user;
    }
}
