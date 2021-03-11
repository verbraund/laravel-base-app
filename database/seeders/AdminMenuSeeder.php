<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $newsParent = \App\Models\Admin\Menu::factory()->create(['name' => 'Новости']);
        \App\Models\Admin\Menu::factory()->for($newsParent, 'parents')->create([
            'name' => 'Новости',
            'urn' => '/admin/news'
        ]);
        \App\Models\Admin\Menu::factory()->for($newsParent, 'parents')->create([
            'name' => 'Категории',
            'urn' => '/admin/news/categories'
        ]);

        $usersParent = \App\Models\Admin\Menu::factory()->create(['name' => 'Пользователи']);
        \App\Models\Admin\Menu::factory()->for($usersParent, 'parents')->create([
            'name' => 'Пользователи',
            'urn' => '/admin/users'
        ]);
        \App\Models\Admin\Menu::factory()->for($usersParent, 'parents')->create([
            'name' => 'Роли',
            'urn' => '/admin/roles'
        ]);

    }
}
