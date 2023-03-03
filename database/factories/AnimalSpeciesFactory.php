<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AnimalSpecies;

class AnimalSpeciesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnimalSpecies::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'species_id' => $this->faker->numberBetween(-10000, 10000),
            'species_name' => $this->faker->word,
            'category' => $this->faker->randomElement(/** enum_attributes **/),
            'can_fly' => $this->faker->boolean,
            'can_swim' => $this->faker->boolean,
            'eating_style' => $this->faker->randomElement(/** enum_attributes **/),
        ];
    }
}
