<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UsersVacancy;
use App\Models\Vacancy;

class UsersVacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsersVacancy::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'users_vacancies_id' => $this->faker->word,
            'user_id' => User::factory()->create()->user_id,
            'vacancy_id' => Vacancy::factory()->create()->vacancy_id,
            'time_joined' => $this->faker->dateTime(),
        ];
    }
}
