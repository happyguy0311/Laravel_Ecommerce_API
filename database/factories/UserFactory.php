<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name();
        dump(strlen('superadmin'));

        return [
            'city_id' => City::inRandomOrder()->first(),
            'name' => $name,
            'username' => str($name)->slug(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '08' . rand(11111111111, 99999999999),
            'nik' => fake()->nik(),
            'role' => fake()->randomElement(['SUPERADMIN', 'ADMIN', 'MERCHANT', 'CUSTOMER']),
            'status' => fake()->randomElement(['ACTIVE', 'INACTIVE']),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('password@123'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
