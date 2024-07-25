<?php

namespace Database\Seeders;

use App\Models\PageContent;
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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin1234'
        ]);

        PageContent::create([
            'logo' => 'image.jpg',
            'companyName' => 'Example Company',
            'about' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, velit.',
            'email' => 'admin@example.com',
            'phone' => '0100000000000',
            'address' => 'New York',
            'maps' => 'New York',
        ]);
    }
}
