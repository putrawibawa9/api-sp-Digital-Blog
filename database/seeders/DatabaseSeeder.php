<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => bcrypt('password'),
        ]);

        Post::create([
            'title' => 'Judul Post Pertama',
            'content' => 'Konten Post Pertama',
            'user_id' => '1',
        ], [
            'title' => 'Judul Post Kedua',
            'content' => 'Konten Post Kedua',
            'user_id' => '2',
        ]);
    }
}
