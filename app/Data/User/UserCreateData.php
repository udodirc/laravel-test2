<?php

namespace App\Data\User;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserCreateData extends Data
{
    public $email;
    public $name;
    public $password;
    public $emailVerifiedAt;

    public function __construct(
        string $email,
        string $name,
        string $password,
        Carbon|Optional|null $emailVerifiedAt = new Optional()
    ) {
        $this->emailVerifiedAt = $emailVerifiedAt;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
    }
}
