<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Qualification;
use App\Models\QualificationsVacancy;
use App\Models\Vacancy;

class QualificationsVacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QualificationsVacancy::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'qualifications_vacancies_id' => $this->faker->word,
            'qualification_id' => Qualification::factory()->create()->qualification_id,
            'vacancy_id' => Vacancy::factory()->create()->vacancy_id,
        ];
    }
}
