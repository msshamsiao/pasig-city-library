<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\MemberLibrary;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
         return [
            'member_library' => \App\Models\MemberLibrary::all()->random(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // You can use 'password' or any default password you prefer
            'registration_status' => 'pending',
            'admin' => 0,
         ];
    }
}
