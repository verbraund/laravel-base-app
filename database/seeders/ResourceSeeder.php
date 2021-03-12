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

        \App\Models\Resource::factory()->create(['name' => \App\Models\Media\News\News::class, 'label' => 'Новости']);
        \App\Models\Resource::factory()->create(['name' => \App\Models\Media\News\NewsCategory::class, 'label' => 'Категории новостей']);
        \App\Models\Resource::factory()->create(['name' => \App\Models\User::class, 'label' => 'Пользователи']);
        \App\Models\Resource::factory()->create(['name' => \App\Models\Role::class, 'label' => 'Роли пользователей']);

    }
}
