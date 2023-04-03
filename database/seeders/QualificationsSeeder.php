<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Qualification::factory(10)->create();

        Qualification::factory()->create([
            'qualification_name' => 'Licensed Forklifter',
            'qualification_description' => 'A license issued by the National Forklift Administration.'
        ]);
    }
}
