<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\permissions>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id')->toArray();
        return [
            'user_id'       => $this->faker->randomElement($users),
            'date'          => $this->faker->dateTimeBetween('-1 month', 'now'),
            'reason'        => $this->faker->text(),
            'image'         => $this->faker->imageUrl(),
            'is_approved'   => $this->faker->boolean(),
        ];
    }
}
