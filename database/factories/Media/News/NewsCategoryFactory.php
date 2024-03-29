<?php


namespace Database\Factories\Media\News;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Media\News\NewsCategory;
use App\Models\User;

class NewsCategoryFactory extends Factory
{

    protected $model = NewsCategory::class;

    public function definition()
    {
        $name = $this->faker->word();
        return [
            'user_id' => $this->faker->randomElement(
                User::all()->pluck('id')->toArray()
            ),
            'title' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
