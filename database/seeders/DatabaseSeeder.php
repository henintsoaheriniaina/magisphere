<?php

namespace Database\Seeders;

use App\Models\Post;
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
        $this->call(AffiliationSeeder::class);
        $this->call(RoleSeeder::class);
        User::factory(1)->create();
        // Post::factory(100)->create();
        $user = User::first();
        $user->assignRole('admin');
    }
}
