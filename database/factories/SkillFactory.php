<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Skill;

class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 'skill_id' => $this->faker->word,
           'skill_name' => $this->faker->randomElement(['Speed', 'Electroreception', 'Night Vision', 'Olfacation', 'Echolocation', 'Hunting', 'Camoflage', 'Bubble coralling', 'Immortality', 'Poison', 'Venom', 'UV resistance', 'Liquidification at will', 'Limb regeneration', 'Adobe', 'Affinity', 'Audio Editing', 'Autocad', 'Blogging', 'Bootstrap', 'C Programming', 'C#', 'C++', 'CSS' ]),
           // 'skill_name' => $this->faker->randomElement(),
            'skill_description' => $this->faker->text,
        ];
    }
}
