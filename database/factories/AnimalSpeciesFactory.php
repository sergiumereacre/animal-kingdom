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
            // 'species_id' => $this->faker->numberBetween(1, 2),
            'species_name' => $this->faker->word,
            'category' => $this->faker->randomElement(['MAMMAL', 'AVIAN', 'AMPHIBIAN', 'FISH', 'REPTILE']),
            'can_fly' => $this->faker->boolean,
            'can_swim' => $this->faker->boolean,
            'can_climb' => $this->faker->boolean,
            'eating_style' => $this->faker->randomElement(['HERBIVORE', 'CARNIVORE', 'OMNIVORE']),
            'produces_toxins' => $this->faker->boolean,
            'size' => $this->faker->randomElement(['SMALL', 'MEDIUM', 'LARGE']),
            'speed' => $this->faker->randomElement(['SLOW', 'MEDIUM', 'FAST']),
            'num_appendages' => $this->faker->randomElement(['NONE', 'FEW', 'MANY']),

        ];
    }
}
