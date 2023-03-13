<?php

namespace Database\Seeders;

use App\Models\Organisation;
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
        ->has(Organisation::factory()->count(3), 'organisations')
        ->create();

        // Organisation::factory()->create();
    }
}
