<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\Organisation;
use App\Models\QualificationsUser;
use App\Models\QualificationsVacancy;
use App\Models\SkillsUser;
use App\Models\SkillsVacancy;
use App\Models\User;
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
        ->has(Organisation::factory()->count(2) 
        ->has(Vacancy::factory()->count(5)
        ->has(SkillsVacancy::factory()->count(2), 'skillsVacancy')
        ->has(QualificationsVacancy::factory()->count(2), 'qualificationsVacancy')
            , 'vacancies')
            , 'organisations')
        ->has(SkillsUser::factory()->count(5), 'skillsUsers')
        ->has(QualificationsUser::factory()->count(2), 'qualificationsUsers')
        ->create([
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test'),
            'is_admin' => true,
            'species_id' => 1,
            'first_name' => 'test',
            'last_name' => 'test'
        ]);

        \App\Models\User::factory(1)
        ->has(Organisation::factory()->count(1)
            ->has(Vacancy::factory()->count(1)
                ->has(SkillsVacancy::factory()->count(2), 'skillsVacancy')
                ->has(QualificationsVacancy::factory()->count(2), 'qualificationsVacancy')
        , 'vacancies')
        , 'organisations')
        ->has(SkillsUser::factory()->count(3), 'skillsUsers')
        ->has(QualificationsUser::factory()->count(2), 'qualificationsUsers')
        ->create([
            'password' => Hash::make('test'),
        ]);

        User::factory(10)
        ->has(Organisation::factory()->count(3)
            ->has(Vacancy::factory()->count(3)
                ->has(SkillsVacancy::factory()->count(3), 'skillsVacancy')
                ->has(QualificationsVacancy::factory()->count(3), 'qualificationsVacancy')
        , 'vacancies'), 
        'organisations')
        ->has(SkillsUser::factory()->count(3), 'skillsUsers')
        ->has(QualificationsUser::factory()->count(3), 'qualificationsUsers')
        ->create([
            'password' => Hash::make('test'),
        ]);

        // Testing connections
        $first_group = User::factory(5)->create([
            'password' => Hash::make('test'),
        ]);

        $second_group = User::factory(5)->create([
            'password' => Hash::make('test'),
        ]);

        $third_group = User::factory(5)->create([
            'password' => Hash::make('test'),
        ]);

        foreach($first_group as $key=>$member){
            Connection::factory()->create([
                'first_user_id' => $member->id,
                'second_user_id' => $second_group[$key]->id,
            ]);
        }

        foreach($third_group as $key=>$member){
            Connection::factory()->create([
                'first_user_id' => $first_group[0]->id,
                'second_user_id' => $third_group[$key]->id,
            ]);
        }


    }
}
