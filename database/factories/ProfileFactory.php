<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Profile;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Profile::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  // ユーザーと関連付け
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birthday' => $this->faker->date(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'avatar' => $this->faker->imageUrl(),
            'introduction' => $this->faker->sentence(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
        ];
    }
}
