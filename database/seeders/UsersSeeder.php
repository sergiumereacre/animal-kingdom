<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\SkillsUser;
use App\Models\Vacancy;
use Database\Factories\OrganisationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()
        ->has(Organisation::factory()->count(3), 'organisations')
        ->create([
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test'),
            'is_admin' => false,
            'species_id' => 1,
            'first_name' => 'test',
            'last_name' => 'test'
        ]);

        \App\Models\User::factory(20)
        ->has(Organisation::factory()->count(1)
        ->has(Vacancy::factory()->count(1), 'vacancies')
        , 'organisations')
        ->has(SkillsUser::factory()->count(3), 'skillsUsers')
        ->create([
            'password' => Hash::make('test'),
        ]);

        \App\Models\User::factory(10)
        ->has(Organisation::factory()->count(2)
        ->has(Vacancy::factory()->count(1), 'vacancies'), 'organisations')
        ->create([
            'password' => Hash::make('test'),
        ]);
    }
}
