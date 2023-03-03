<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Connection;
use App\Models\User;

class ConnectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Connection::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'connection_id' => $this->faker->numberBetween(-10000, 10000),
            'first_user_id' => User::factory()->create()->user_id,
            'second_user_id' => User::factory()->create()->user_id,
            'time_created' => $this->faker->dateTime(),
        ];
    }
}
