<?php

namespace App\Http\Repositories;

use App\Data\User\UserCreateData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Optional;

class UserRepository
{
    const ADMIN_ROLE = 1;
    const USER_ROLE = 0;

    public function create(UserCreateData $data): User
    {
        $user = new User();
        $user->email = $data->email;;
        $user->password = Hash::make($data->password);
        $user->name = $data->name;

        if (! $data->emailVerifiedAt instanceof Optional) {
            $user->email_verified_at = $data->emailVerifiedAt;
        }

        $user->save();

        return $user;
    }

    public function users(int $role): Collection
    {
        return User::all()->where('admin', $role);
    }
}
