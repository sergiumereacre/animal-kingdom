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
            'qualification_name' => $this->faker->randomElement(['Speed', 'Electroreception', 'Night Vision', 'Olfacation', 'Echolocation', 'Hunting', 'Camoflage', 'Bubble coralling', 'Immortality', 'Poison', 'Venom', 'UV resistance', 'Liquidification at will', 'Limb regeneration', 'Adobe', 'Affinity', 'Audio Editing', 'Autocad', 'Blogging', 'Bootstrap', 'C Programming', 'C#', 'C++', 'CSS' ]),
            'qualification_description' => $this->faker->text,
        ];
    }
}
