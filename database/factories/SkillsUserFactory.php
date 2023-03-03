<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Skill;
use App\Models\SkillsUser;
use App\Models\User;

class SkillsUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SkillsUser::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'skills_users_id' => $this->faker->word,
            'user_id' => User::factory()->create()->user_id,
            'skill_id' => Skill::factory()->create()->skill_id,
            'skill_level' => $this->faker->randomElement(/** enum_attributes **/),
        ];
    }
}
