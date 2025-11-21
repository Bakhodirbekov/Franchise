<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    public function createAdmin()
    {
        // Admin user yaratish
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '+1234567890',
            'password' => Hash::make('Password123!'),
            'role' => 'admin',
            'company' => 'FranchiseShop Inc.',
            'address' => '123 Admin Street',
        ]);

        return "Admin user created successfully!\nEmail: admin@example.com\nPassword: Password123!";
    }
}