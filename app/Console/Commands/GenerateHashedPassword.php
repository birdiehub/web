<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateHashedPassword extends Command
{
    // example: php artisan generate:password {password}

    protected $signature = 'generate:password {password}';

    protected $description = 'Generate a hashed password';

    public function handle(): void
    {
        $password = $this->argument('password');
        $hashedPassword = Hash::make($password);

        $this->info("The hashed password is: $hashedPassword");
    }
}
