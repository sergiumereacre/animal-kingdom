<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        // \App\Models\AnimalSpecies::factory(10)->create();

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

        \App\Models\User::factory()->create([
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test'),
            'is_admin' => false,
            'species_id' => 1,
            'first_name' => 'test',
            'last_name' => 'test'
        ]);
    }
}
