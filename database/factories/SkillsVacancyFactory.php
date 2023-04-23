<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Skill;
use App\Models\SkillsVacancy;
use App\Models\Vacancy;

class SkillsVacancyFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SkillsVacancy::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            //'skills_vacancies_id' => $this->faker->numberBetween(-10000, 10000),
            //'skill_id' => Skill::factory()->create()->skill_id,
            'skill_id' => Skill::factory()->create()->skill_id,
            'vacancy_id' => Vacancy::factory()->create()->vacancy_id,
            'skill_level' => $this->faker->randomElement(['BEGINNER', 'INTERMEDIATE', 'EXPERT']),
        ];
    }
}
