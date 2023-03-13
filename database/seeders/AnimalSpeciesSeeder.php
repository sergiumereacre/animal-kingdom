<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalSpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AnimalSpecies::factory()->create([
            'species_id' => 1,
            'species_name' => 'frog',
            'category' => 'AMPHIBIAN',
            'can_fly' => false,
            'can_swim' => true,
            'can_climb' => false,
            'eating_style' => 'CARNIVORE',
            'produces_toxins' => false,
            'size' => 'SMALL',
            'speed' => 'MEDIUM',
            'num_appendages' => 'FEW'
        ]);

        \App\Models\AnimalSpecies::factory()->create([
            'species_id' => 2,
            'species_name' => 'fox',
            'category' => 'MAMMAL',
            'can_fly' => false,
            'can_swim' => true,
            'can_climb' => true,
            'eating_style' => 'OMNIVORE',
            'produces_toxins' => false,
            'size' => 'MEDIUM',
            'speed' => 'MEDIUM',
            'num_appendages' => 'FEW'
        ]);
    }
}
