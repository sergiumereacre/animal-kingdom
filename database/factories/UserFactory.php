<?php

namespace Database\Factories;

use App\Models\AnimalSpecies;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Organisation;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**Define the model's default state.
     * The name of the factory's corresponding model.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    /** @return array<string, mixed>
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            // 'id' => $this->faker->word,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'is_admin' => $this->faker->boolean,
            'species_id' => 1,
            // 'species_id' => AnimalSpecies::factory()->create()->species_id,
            'username' => $this->faker->userName,
            'password' => $this->faker->password,
            'address' => $this->faker->address(),
            'date_of_birth' => $this->faker->date(),
            // 'organisation_id' => Organisation::factory()->create()->organisation_id,
            'contact_number' => $this->faker->phoneNumber(),
            // 'is_banned' => $this->faker->boolean,
            'bio' => $this->faker->paragraph(),
            // 'profile_pic' => $this->faker->word,
        ];
    }

        /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
}
}
