<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Media\News\NewsCategory::factory(12)
            ->has(\App\Models\Media\News\News::factory()->count(14))
            ->create();
    }
}
