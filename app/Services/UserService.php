<?php

namespace App\Services;

use App\Data\User\UserCreateData;
use App\Http\Repositories\UserRepository;
use App\Jobs\SendUserNotification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public static function formUserList(array $users): array
    {
        $userList = [];
        foreach ($users as $user) {
            $userList[] = [
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2])
            ];
        }

        return $userList;
    }

    public static function getUsersFromCSV(): array
    {
        $userList = [];
        $filePath = 'public/users/import.csv';

        if (Storage::exists($filePath)) {
            $filePath = storage_path('app/'.$filePath);
            $users = FileService::parseCsv($filePath);

            if (!empty($users)) {
                array_shift($users);
                $userList = self::formUserList($users);
            }
        }

        return $userList;
    }

    public function import(): bool
    {
        $result = false;
        $users = self::getUsersFromCSV();

        if (!empty($users)) {
            $result = User::insert($users);
            self::sendBatchEmails($users);
        }

        return $result;
    }

    public function sendBatchEmails($users)
    {
        foreach ($users as $user) {
            SendUserNotification::dispatch($user);
        }
    }
}
