<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Companies>
 */
class CompaniesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'company_name' => $this->faker->company,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'logo' => $this->faker->imageUrl(),
            // 'website' => $this->faker->url,
        ];
    }
}
