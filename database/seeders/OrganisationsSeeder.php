<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrganisationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Organisation::factory()->create();
    }
}
