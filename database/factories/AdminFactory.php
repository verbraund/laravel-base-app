<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'login' => 'admin',
            'password' => '$2y$10$jBndEfRKb/NvVhecsHlHsOuGy/FR9bDRJASRvkGHMWgbKmfKzN.Vy', // 123
            'tfa' => 0,
            'tfa_code' => null,
        ];
    }
}
