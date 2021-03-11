<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Resource::factory()->create(['name' => \App\Models\Media\News\News::class]);
        \App\Models\Resource::factory()->create(['name' => \App\Models\Media\News\NewsCategory::class]);
        \App\Models\Resource::factory()->create(['name' => \App\Models\User::class]);
        \App\Models\Resource::factory()->create(['name' => \App\Models\Role::class]);

    }
}
