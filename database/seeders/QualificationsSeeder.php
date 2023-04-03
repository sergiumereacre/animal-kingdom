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

        $data = [
            [
                'qualification_name' => 'Licensed Forklifter',
                'qualification_description' => 'A license issued by the National Forklift Administration.'
            ],
            [
                'qualification_name' => 'BSc Computer Science',
                'qualification_description' => 'A Bachelor\'s degree in Computer Science.'
            ],
        ];

        Qualification::insert($data);
    }
}
