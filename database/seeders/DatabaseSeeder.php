<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Franchise;
use App\Models\FranchiseImage;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '+1234567890',
            'password' => Hash::make('Password123!'),
            'role' => 'admin',
            'company' => 'FranchiseShop Inc.',
            'address' => '123 Admin Street, City, Country',
            'email_verified_at' => now(),
        ]);

        // Create categories
        $categories = [
            'Food & Beverage',
            'Retail',
            'Service',
            'Health & Fitness',
            'Education',
            'Automotive',
            'Home Services',
            'Business Services'
        ];

        $categoryIds = [];
        foreach ($categories as $categoryName) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName)
            ]);
            $categoryIds[] = $category->id;
        }

        // Sample franchises data - TO'G'RI SLUG LAR BILAN
        $franchisesData = [
            [
                'title' => 'Coffee Corner',
                'slug' => 'coffee-corner',
                'category_id' => $categoryIds[0], // Food & Beverage
                'short_description' => 'Premium coffee shop franchise with proven business model',
                'description' => 'Join our successful coffee shop franchise with comprehensive training and ongoing support. Perfect for first-time business owners.',
                'investment_min' => 80000,
                'investment_max' => 150000,
                'royalty' => 6.0,
                'territory' => 'Regional',
                'requirements' => json_encode(['Liquid capital: $50,000', 'Business experience', 'Management skills']),
                'status' => 'published',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'FitLife Gym',
                'slug' => 'fitlife-gym',
                'category_id' => $categoryIds[3], // Health & Fitness
                'short_description' => 'Modern fitness center franchise opportunity',
                'description' => 'Open your own FitLife Gym with our turnkey solution. Includes equipment, training, and marketing support.',
                'investment_min' => 120000,
                'investment_max' => 300000,
                'royalty' => 5.5,
                'territory' => 'Exclusive territory',
                'requirements' => json_encode(['Fitness background', 'Management experience', 'Liquid capital: $75,000']),
                'status' => 'published',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'QuickClean Services',
                'slug' => 'quickclean-services',
                'category_id' => $categoryIds[2], // Service
                'short_description' => 'Residential and commercial cleaning franchise',
                'description' => 'Start your own cleaning business with our proven system. Low overhead, high demand service.',
                'investment_min' => 25000,
                'investment_max' => 50000,
                'royalty' => 8.0,
                'territory' => 'Protected territory',
                'requirements' => json_encode(['No experience needed', 'Basic business skills', 'Liquid capital: $15,000']),
                'status' => 'published',
                'created_by' => $admin->id,
            ]
        ];

        // Create franchises
        foreach ($franchisesData as $franchiseData) {
            $franchise = Franchise::create($franchiseData);

            // Add sample images
            FranchiseImage::create([
                'franchise_id' => $franchise->id,
                'path' => 'sample/franchise-' . $franchise->id . '.jpg',
                'alt' => $franchise->title,
                'order' => 0,
            ]);

            $this->command->info("Created franchise: {$franchise->title} with slug: {$franchise->slug}");
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Admin Login: admin@example.com');
        $this->command->info('🔑 Password: Password123!');
        $this->command->info('');
        $this->command->info('🌐 Website: http://localhost:8000');
        $this->command->info('⚡ Admin Panel: http://localhost:8000/admin');
        $this->command->info('');
        $this->command->info('📊 Sample franchises with slugs:');
        $this->command->info('   - coffee-corner');
        $this->command->info('   - fitlife-gym');
        $this->command->info('   - quickclean-services');
    }
}