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
        // Qualification::factory(10)->create();

        $data = [
            [
                'qualification_name' => 'Licensed Forklifter',
                'qualification_description' => 'A license issued by the National Forklift Administration.'
            ],
            [
                'qualification_name' => 'BSc Computer Science',
                'qualification_description' => 'A Bachelor\'s degree in Computer Science.'
            ],
            [
                'qualification_name' => 'MSc Computer Science',
                'qualification_description' => 'A Master\'s degree in Computer Science.'
            ],
            [
                'qualification_name' => 'BSc Computer Science',
                'qualification_description' => 'A Bachelor\'s degree in Computer Science.'
            ],
            [
                'qualification_name' => 'Certified Scrum Master',
                'qualification_description' => 'A certification issued by the Scrum Alliance.'
            ],
            [
                'qualification_name' => 'Certified Windows Server Administrator',
                'qualification_description' => 'A certification issued by Microsoft.'
            ],
            [
                'qualification_name' => 'Bachelor\'s',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Master\'s',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Doctorate',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Diploma',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'First Aid Certificate',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Food Safety Certificate',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Driver\'s License',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Garda Vetting',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Manual Handling Certificate',
                'qualification_description' => ''
            ],
            [
                'qualification_name' => 'Language Certificate',
                'qualification_description' => ''
            ],
            
        ];

        Qualification::insert($data);
    }
}