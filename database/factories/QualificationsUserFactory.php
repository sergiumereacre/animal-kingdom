<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Qualification;
use App\Models\QualificationsUser;
use App\Models\User;

class QualificationsUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QualificationsUser::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 'qualifications_users_id' => $this->faker->word,
            'user_id' => User::factory()->create()->user_id,
            'qualification_id' => Qualification::factory()->create()->qualification_id,
            'date_obtained' => $this->faker->date(),
        ];
    }
}
