<?php


namespace Database\Factories\Media\News;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Media\News\NewsCategory;

class NewsCategoryFactory extends Factory
{

    protected $model = NewsCategory::class;

    public function definition()
    {
        $name = $this->faker->word();
        return [
            'title' => $name,
            'slug' => Str::slug($name),
            'user_id' => 1
        ];
    }
}
