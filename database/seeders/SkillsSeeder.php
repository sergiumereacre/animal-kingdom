<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Skill::factory(10)->create();
        
        Skill::factory()->create([
            'skill_name' => 'Gambling',
            'skill_description' => 'A user\'s proficiency in the art of leaving their fate to Lady Luck.'
        ]);

    }
}
