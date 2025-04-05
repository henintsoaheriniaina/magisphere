<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Affiliation;

class AffiliationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $affiliations = [
            ['label' => 'Personnel'],
            ['label' => 'L1 INFO'],
            ['label' => 'L2 IGLD'],
            ['label' => 'L2 MSI'],
            ['label' => 'L3 IGLD'],
            ['label' => 'L3 MSI'],
            ['label' => 'L1 SAMIS'],
            ['label' => 'L2 SAMIS'],
            ['label' => 'L3 SAMIS'],
            ['label' => 'L1 ETS'],
            ['label' => 'L2 ETS'],
            ['label' => 'L3 ETS'],
        ];

        foreach ($affiliations as $affiliation) {
            Affiliation::create($affiliation);
        }
    }
}
