<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Packet;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'fullname' => env('SUPERADMIN_FULLNAME'),
            'username' => env('SUPERADMIN_USERNAME'),
            'password' => bcrypt(env('SUPERADMIN_PASSWORD')),
            'email' => env('SUPERADMIN_EMAIL'),
            'number_phone' => env('SUPERADMIN_NUMBER_PHONE'),
            'role' => env('SUPERADMIN_ROLE'),
            'is_verified' => true
        ]);

        User::create([
            'fullname' => env('ADMIN_FULLNAME'),
            'username' => env('ADMIN_USERNAME'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'email' => env('ADMIN_EMAIL'),
            'number_phone' => env('ADMIN_NUMBER_PHONE'),
            'role' => env('ADMIN_ROLE'),
            'is_verified' => true
        ]);

        $categories = ['venue', 'mua', 'catering'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
