<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-test-user {--admin : Create as admin user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test user for development';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter user name', 'Test User');
        $email = $this->ask('Enter user email', 'test@example.com');
        $password = $this->secret('Enter password', 'password');
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $this->option('admin') ? 'admin' : 'user',
            'email_verified_at' => now(),
        ]);
        
        $this->info('User created successfully!');
        $this->info('Email: ' . $email);
        $this->info('Password: ' . $password);
        $this->info('Role: ' . $user->role);
    }
}