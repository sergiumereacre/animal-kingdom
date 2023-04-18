<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\AnimalSpecies;

class AnimalSpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'AMPHIBIAN',
            'AVIAN',
            'FISH',
            'MAMMAL',
            'REPTILE'
        ];

        $data = [
            [
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
            ],
            [
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
            ],
            [
                'species_id' => 3,
                'species_name' => 'eagle',
                'category' => 'AVIAN',
                'can_fly' => true,
                'can_swim' => false,
                'can_climb' => false,
                'eating_style' => 'CARNIVORE',
                'produces_toxins' => false,
                'size' => 'MEDIUM',
                'speed' => 'FAST',
                'num_appendages' => 'FEW'
            ],
            [
                'species_id' => 4,
                'species_name' => 'dolphin',
                'category' => 'MAMMAL',
                'can_fly' => false,
                'can_swim' => true,
                'can_climb' => false,
                'eating_style' => 'CARNIVORE',
                'produces_toxins' => false,
                'size' => 'LARGE',
                'speed' => 'FAST',
                'num_appendages' => 'FEW'
            ],
            [
                'species_id' => 5,
                'species_name' => 'shark',
                'category' => 'FISH',
                'can_fly' => false,
                'can_swim' => true,
                'can_climb' => false,
                'eating_style' => 'CARNIVORE',
                'produces_toxins' => true,
                'size' => 'LARGE',
                'speed' => 'FAST',
                'num_appendages' => 'FEW'
            ],
            [
                'species_id' => 6,
                'species_name' => 'snake',
                'category' => 'REPTILE',
                'can_fly' => false,
                'can_swim' => false,
                'can_climb' => true,
                'eating_style' => 'CARNIVORE',
                'produces_toxins' => true,
                'size' => 'MEDIUM',
                'speed' => 'MEDIUM',
                'num_appendages' => 'FEW'
            ],
            [
                'species_id' => 7,
                'species_name' => 'monkey',
                'category' => 'MAMMAL',
                'can_fly' => false,
                'can_swim' => false,
                'can_climb' => true,
                'eating_style' => 'OMNIVORE',
                'produces_toxins' => false,
                'size' => 'MEDIUM',
                'speed' => 'MEDIUM',
                'num_appendages' => 'FEW'
            ],
            [
                'species_id' => 8,
                'species_name' => 'parrot',
                'category' => 'AVIAN',
                'can_fly' => true,
                'can_swim' => false,
                'can_climb' => false,
                'eating_style' => 'HERBIVORE',
                'produces_toxins' => false,
                'size' => 'SMALL',
                'speed' => 'MEDIUM',
                'num_appendages' => 'FEW'
            ],
            [
                'species_id' => 9,
                'species_name' => 'whale',
                'category' => 'MAMMAL',
                'can_fly' => false,
                'can_swim' => true,
                'can_climb' => false,
                'eating_style' => 'HERBIVORE',
                'produces_toxins' => false,
                'size' => 'LARGE',
                'speed' => 'SLOW',
                'num_appendages' => 'FEW'
            ],
            [
                'species_id' => 10,
                'species_name' => 'tiger',
                'category' => 'MAMMAL',
                'can_fly' => false,
                'can_swim' => false,
                'can_climb' => true,
                'eating_style' => 'CARNIVORE',
                'produces_toxins' => false,
                'size' => 'LARGE',
                'speed' => 'FAST',
                'num_appendages' => 'FEW'
            ]

        ];

        AnimalSpecies::insert($data);


        // AnimalSpecies::factory()->create([
        //     'species_id' => 1,
        //     'species_name' => 'frog',
        //     'category' => 'AMPHIBIAN',
        //     'can_fly' => false,
        //     'can_swim' => true,
        //     'can_climb' => false,
        //     'eating_style' => 'CARNIVORE',
        //     'produces_toxins' => false,
        //     'size' => 'SMALL',
        //     'speed' => 'MEDIUM',
        //     'num_appendages' => 'FEW'
        // ]);

        // AnimalSpecies::factory()->create([
        //     'species_id' => 2,
        //     'species_name' => 'fox',
        //     'category' => 'MAMMAL',
        //     'can_fly' => false,
        //     'can_swim' => true,
        //     'can_climb' => true,
        //     'eating_style' => 'OMNIVORE',
        //     'produces_toxins' => false,
        //     'size' => 'MEDIUM',
        //     'speed' => 'MEDIUM',
        //     'num_appendages' => 'FEW'
        // ]);


    }
}
