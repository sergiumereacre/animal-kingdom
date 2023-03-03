<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Organisation;
use App\Models\Vacancy;

class VacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacancy::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vacancy_id' => $this->faker->word,
            'time_created' => $this->faker->dateTime(),
            'organisation_id' => Organisation::factory()->create()->organisation_id,
            'vacancy_title' => $this->faker->word,
            'vacancy_description' => $this->faker->text,
            'category_requirement' => $this->faker->randomElement(/** enum_attributes **/),
            'can_fly_requirement' => $this->faker->boolean,
            'can_swim_requirement' => $this->faker->boolean,
            'eating_style_requirement' => $this->faker->randomElement(/** enum_attributes **/),
        ];
    }
}
