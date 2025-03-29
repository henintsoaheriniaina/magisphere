<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AffiliationSeeder::class);
        $this->call(RoleSeeder::class);
        User::factory(40)->create();
        Post::factory(50)->create();
        $users = User::get();
        foreach ($users as $user) {
            $user->assignRole('user');
        }

        $user = User::create([
            'lastname' => "Rasolomampionona",
            'firstname' => "Henintsoa Heriniaina",
            'email' => "belouhtsoa@gmail.com",
            'matriculation' => "ETSI-4000",
            'password' => Hash::make('p@ssw0rd9*'),
            'remember_token' => Str::random(10),
            'affiliation_id' => 1,
            'status' => 'approved',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
    }
}
