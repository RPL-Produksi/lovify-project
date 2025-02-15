<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\Packet;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
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

        for ($i = 2; $i <= 6; $i++) {
            User::create([
                'fullname' => 'Mitra ' . $i,
                'username' => 'mitra' . $i,
                'password' => bcrypt('mitra123'),
                'email' => 'mitra' . $i . '@example.com',
                'phone_number' => '08123456789' . $i,
                'role' => 'mitra',
                'is_verified' => true,
                'avatar' => null,
            ]);
        }

        $mitras = User::where('role', 'mitra')
            ->orderBy('created_at', 'asc') // Mengurutkan berdasarkan tanggal pembuatan
            ->take(6) // Membatasi hasil hanya 6
            ->get();

        $locations = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Malang'];
        foreach ($locations as $location) {
            Location::create([
                'name' => $location,
            ]);
        }

        foreach ($mitras as $mitra) {
            $category = Category::where('name', $categories[rand(0, 5)])->first();
            $location = Location::where('name', $locations[rand(0, 5)])->first();
            Vendor::create([
                'name' => $mitra->fullname,
                'email' => $mitra->email,
                'phone_number' => $mitra->phone_number,
                'profile' => null,
                'mitra_id' => $mitra->id,
                'category_id' => $category->id,
                'location_id' => $location->id,
            ]);
        }

        $vendors = Vendor::orderBy('created_at', 'asc')->take(6)->get();
        for ($i = 1; $i <= 5; $i++) {
            foreach ($vendors as $vendor) {
                $path = 'products/' . $vendor->category->name . $i . '.jpg';
                $toLower = strtolower($vendor->category->name . ' ' . $i);
                $slug = str_replace([' ', '/'], '-', $toLower);
                Product::create([
                    'name' => $vendor->category->name . ' ' . $i,
                    'slug' => $slug,
                    'price' => [100000, 200000, 300000, 400000, 500000][rand(0, 4)],
                    'description' => 'Description ' . $vendor->category->name . ' ' . $i,
                    'cover' => Storage::url($path),
                    'vendor_id' => $vendor->id,
                    'status' => 'active',
                ]);
            }
        }
    }
}
