<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'user_id'   => $this->faker->randomElement($users),
            'date'      => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'check_in'  => $this->faker->time(),
            'check_out' => $this->faker->time(),
            'lat_long_in'   => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'lat_long_out'  => $this->faker->latitude() . ',' . $this->faker->longitude(),
        ];
    }
}
