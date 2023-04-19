<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SkillsUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        // \App\Models\AnimalSpecies::factory(10)->create();

        // Calling all seeders
        $this->call([
            SkillsSeeder::class,
            QualificationsSeeder::class,
            SkillsUserSeeder::class,
            AnimalSpeciesSeeder::class,
            UsersSeeder::class,
        ]);




    }
}
