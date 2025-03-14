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
            ['label' => 'L1 info'],
            ['label' => 'L2 info'],
            ['label' => 'L3 info'],
        ];

        foreach ($affiliations as $affiliation) {
            Affiliation::create($affiliation);
        }
    }
}
