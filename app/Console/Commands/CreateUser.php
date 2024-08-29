<?php

namespace App\Console\Commands;

use App\Data\User\UserCreateData;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-user {email} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle(UserService $userService): int
    {
        $password = Str::random(12);

        $data = new UserCreateData(
            $this->argument('email'),
            $this->argument('name'),
            $password,
        );

        $userService->create($data);

        $this->info("Password: $data->password");

        return 0;
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'Enter name',
            'email' => 'Enter email',
        ];
    }
}
