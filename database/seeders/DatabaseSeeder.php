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
            'phone_number' => env('SUPERADMIN_PHONE_NUMBER'),
            'role' => env('SUPERADMIN_ROLE'),
            'is_verified' => null
        ]);

        User::create([
            'fullname' => env('ADMIN_FULLNAME'),
            'username' => env('ADMIN_USERNAME'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'email' => env('ADMIN_EMAIL'),
            'phone_number' => env('ADMIN_PHONE_NUMBER'),
            'role' => env('ADMIN_ROLE'),
            'is_verified' => null
        ]);

        $categories = ['venue', 'mua', 'catering'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
