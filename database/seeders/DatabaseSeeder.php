<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Packet;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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

        User::create([
            'fullname' => 'Mitra 1',
            'username' => 'mitra1',
            'password' => bcrypt('mitra123'),
            'email' => 'mitra@example.com',
            'phone_number' => '081234567890',
            'role' => 'mitra',
            'is_verified' => true
        ]);

        $categories = ['venue', 'mua', 'catering', 'photographer', 'organize', 'decoration'];
        foreach ($categories as $category) {
            $path = 'categories/' . $category . '.jpg';
            Category::create([
                'name' => $category,
                'image' => Storage::url($path),
            ]);
        }

        // id	mitra_id	category_id	name	slug	description	price	cover	status	
        $categories = Category::all();
        for ($i = 1; $i <= 10; $i++) {
            foreach ($categories as $category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => 'Product ' . $category->name . ' ' . $i,
                    'slug' => 'product-' . $category->name . '-' . $i,
                    'description' => 'Product ' . $category->name . ' ' . $i . ' yang sangat menarik',
                    'price' => [10000, 20000, 50000, 75000, 100000][rand(0,4)],
                    'cover' => $category->image,
                    'status' => 'active',
                    'mitra_id' => User::where('role', 'mitra')->first()->id,
                ]);
            }
        }
    }
}
