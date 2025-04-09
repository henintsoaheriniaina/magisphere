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
        $classes = [
            ['label' => 'PERSONNEL'],
            ['label' => 'ENSEIGNANT'],
            ['label' => 'L1 INFO'],
            ['label' => 'L2 INFO IGLD'],
            ['label' => 'L2 INFO MSIR'],
            ['label' => 'L3 INFO IGLD'],
            ['label' => 'L3 INFO MSIR'],
            ['label' => 'L1 SAMIS'],
            ['label' => 'L2 SAMIS'],
            ['label' => 'L3 SAMIS CM'],
            ['label' => 'L3 SAMIS CO'],
            ['label' => 'L3 SAMIS SE'],
            ['label' => 'M1 SAMIS CM'],
            ['label' => 'M1 SAMIS CO'],
            ['label' => 'M1 SAMIS SE'],
            ['label' => 'M2 SAMIS CM'],
            ['label' => 'M2 SAMIS CO'],
            ['label' => 'M2 SAMIS SE'],
            ['label' => 'L1 ETS'],
            ['label' => 'L2 ETS EM'],
            ['label' => 'L2 ETS GM'],
            ['label' => 'L3 ETS EM'],
            ['label' => 'L3 ETS GM'],
            ['label' => 'M2 ETS EM'],
            ['label' => 'M2 ETS GM'],
            ['label' => 'M1 ETS EM'],
            ['label' => 'M1 ETS GM'],
        ];

        foreach ($classes as $affiliation) {
            Affiliation::create($affiliation);
        }
    }
}
