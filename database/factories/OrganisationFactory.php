<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Organisation;
use App\Models\User;

class OrganisationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organisation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'organisation_id' => $this->faker->word,
            'organisation_name' => $this->faker->word,
            'owner_id' => User::factory()->create()->user_id,
            'time_created' => $this->faker->dateTime(),
            'address' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'contact_number' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
