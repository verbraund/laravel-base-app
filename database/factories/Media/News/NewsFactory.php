<?php

namespace Database\Factories\Media\News;

use App\Models\Media\News\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(100);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->text(200),
            'text' => $this->faker->text(1000),
            'published_at' => $this->faker->dateTime
        ];
    }
}
