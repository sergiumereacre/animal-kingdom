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
            // 'vacancy_id' => $this->faker->word,
            'time_created' => $this->faker->dateTime(),
            // 'organisation_id' => Organisation::factory()->create()->organisation_id,
            'organisation_id' => 1,
            'vacancy_title' => $this->faker->jobTitle(),
            'vacancy_description' => $this->faker->text,
            'category_requirement' => $this->faker->randomElement(
                ['MAMMAL', 'AVIAN', 'AMPHIBIAN', 'FISH', 'REPTILE']
            ),
            'can_fly_requirement' => $this->faker->boolean,
            'can_swim_requirement' => $this->faker->boolean,
            'can_climb_requirement' => $this->faker->boolean,
            'eating_style_requirement' => $this->faker->randomElement(
                ['HERBIVORE', 'CARNIVORE', 'OMNIVORE']
            ),
            'produces_toxins_requirement' => $this->faker->boolean,
            'size_requirement' => $this->faker->randomElement(['SMALL', 'MEDIUM', 'LARGE']),
            'speed_requirement' => $this->faker->randomElement(['SLOW', 'MEDIUM', 'FAST']),
            'num_appendages_requirement' => $this->faker->randomElement(['NONE', 'FEW', 'MANY']),
            'salary_range_lower' => $this->faker->numberBetween(0, 20000),
            'salary_range_upper' => $this->faker->numberBetween(40000, 80000),
        ];
    }
}
