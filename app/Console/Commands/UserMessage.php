<?php

namespace App\Console\Commands;

use App\Http\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Console\Command;

class UserMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:send-message {role} {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send message to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UserService $userService): int
    {
        $role = ($this->argument('role') == 'admin')
            ? UserRepository::ADMIN_ROLE
            : UserRepository::USER_ROLE;
        $userService->sendUserMessage($role, $this->argument('message'));

        return 0;
    }
}
