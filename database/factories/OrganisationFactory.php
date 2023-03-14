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
            // 'organisation_id' => $this->faker->word,
            'organisation_name' => $this->faker->company(),
            // 'owner_id' => User::factory()->create()->id,
            'owner_id' => 1,

            'time_created' => $this->faker->dateTime(),
            'address' => $this->faker->address(),
            'email' => $this->faker->safeEmail,
            'contact_number' => $this->faker->phoneNumber(),
            'description' => $this->faker->text,
            'picture' => null,
            'size' => $this->faker->numberBetween(0, 100000),
        ];
    }
}
