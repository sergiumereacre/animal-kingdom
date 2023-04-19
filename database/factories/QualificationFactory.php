<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Qualification;

class QualificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Qualification::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 'qualification_id' => $this->faker->word,
            'qualification_name' => $this->faker->randomElement(['Bachelor\'s', 'Master\'s', 'Doctorate', 'Diploma', 'First Aid Certificate', 'Food Safety Certificate', 'Driver\'s License', 'Garda Vetting', 'Manual Handling Certificate', 'Language Certificate' ]),
            'qualification_description' => $this->faker->text,
        ];
    }
}
