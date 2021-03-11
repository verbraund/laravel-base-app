<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'login' => 'user_' . $this->faker->unique()->word(),
            'email' => 'verbraund@gmail.com',
            'password' => '$2y$10$jBndEfRKb/NvVhecsHlHsOuGy/FR9bDRJASRvkGHMWgbKmfKzN.Vy', // 123
            'tfa' => 0,
            'tfa_code' => null,
        ];
    }
}
