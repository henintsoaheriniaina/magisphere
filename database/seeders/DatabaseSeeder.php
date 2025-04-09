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
        $user = User::create([
            'lastname' => "Admin",
            'firstname' => "Umagis",
            'email' => "umagis.multimedia@gmail.com",
            'matriculation' => "SE-0000",
            'password' => Hash::make('umagis.multimedia'),
            'remember_token' => Str::random(10),
            'affiliation_id' => 1,
            'status' => 'approved',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
        $user->affiliation_id = 1;
        $user->save();
        $user = User::create([
            'lastname' => "Rasolomampionona",
            'firstname' => "Henintsoa Heriniaina",
            'email' => "rasolomampiononahenintsoaherin@gmail.com",
            'matriculation' => "ETSI-0039",
            'password' => Hash::make('p@ssw0rd9*'),
            'remember_token' => Str::random(10),
            'affiliation_id' => 5,
            'status' => 'approved',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
    }
}
