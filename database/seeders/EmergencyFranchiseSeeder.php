<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Franchise;
use App\Models\Category;
use App\Models\User;
use App\Models\FranchiseImage;
use Illuminate\Support\Facades\Hash;

class EmergencyFranchiseSeeder extends Seeder
{
    public function run()
    {
        // Admin user yaratish
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'phone' => '+1234567890',
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
                'company' => 'FranchiseShop Inc.',
                'address' => '123 Admin Street',
                'email_verified_at' => now(),
            ]
        );

        // Category yaratish
        $category = Category::firstOrCreate(
            ['name' => 'Food & Beverage'],
            ['slug' => 'food-beverage']
        );

        // Franchise yaratish
        $franchise = Franchise::firstOrCreate(
            ['slug' => 'coffee-corner'],
            [
                'title' => 'Coffee Corner',
                'category_id' => $category->id,
                'short_description' => 'Premium coffee shop franchise with proven business model',
                'description' => 'Join our successful coffee shop franchise with comprehensive training and ongoing support. Perfect for first-time business owners.',
                'investment_min' => 80000,
                'investment_max' => 150000,
                'royalty' => 6.0,
                'territory' => 'Regional',
                'requirements' => json_encode(['Business experience', 'Liquid capital', 'Management skills']),
                'status' => 'published',
                'created_by' => $admin->id,
            ]
        );

        // Image yaratish
        FranchiseImage::firstOrCreate(
            ['franchise_id' => $franchise->id],
            [
                'path' => 'sample/coffee-corner.jpg',
                'alt' => 'Coffee Corner Franchise',
                'order' => 0,
            ]
        );

        $this->command->info('✅ Emergency franchise created: coffee-corner');
        $this->command->info('🌐 URL: http://localhost:8000/franchises/coffee-corner');
    }
}