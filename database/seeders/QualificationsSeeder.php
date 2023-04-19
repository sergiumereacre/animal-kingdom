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
                'qualification_name' => 'Bachelor',
            ],
            [
                'qualification_name' => 'Master',
            ],
            [
                'qualification_name' => 'PhD',

            ],
            ['qualification_name' => 'Diploma',
        ],
        [
            'qualification_name' => 'Certificate',
        ],
        [
            'qualification_name' => 'First Aid Certificate',
        ],
        [
            'qualification_name' => 'CPR Certificate',
        ],
        [
            'qualification_name' => 'Food Safety Certificate',
        ],
        [
            'qualification_name' => 'Driver\'s License',
        ],
        [
            'qualification_name' => 'Work Permit',
        ],
        [
            'qualification_name' => 'Work Visa',
        ],
        [
            'qualification_name' => 'Language Certificate',
        ],
        [
            'qualification_name' => 'Other',
        ],
        [
            'qualification_name' => 'Manual Handling Certificate',
        ],
        [
            'qualification_name' => 'Garda Vetting',
        ]
        ];
        Qualification::insert($data);
    }
}