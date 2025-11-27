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
    protected $signature = 'app:create-test-user {--role= : Specify the role (user, vendor, admin, operator)}';

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
        
        // Ask for role if not provided via option
        $role = $this->option('role');
        if (!$role) {
            $role = $this->choice('Select role', ['user', 'vendor', 'admin', 'operator'], 0);
        }
        
        // Validate role
        $validRoles = ['user', 'vendor', 'admin', 'operator'];
        if (!in_array($role, $validRoles)) {
            $this->error('Invalid role. Valid roles are: ' . implode(', ', $validRoles));
            return 1;
        }
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
            'email_verified_at' => now(),
        ]);
        
        $this->info('User created successfully!');
        $this->info('Email: ' . $email);
        $this->info('Password: ' . $password);
        $this->info('Role: ' . $user->role);
    }
}