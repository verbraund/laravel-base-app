<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Permission::factory()->create(['name' => 'view', 'label' => 'Просмотр']);
        \App\Models\Permission::factory()->create(['name' => 'create', 'label' => 'Создение']);
        \App\Models\Permission::factory()->create(['name' => 'update', 'label' => 'Изминение']);
        \App\Models\Permission::factory()->create(['name' => 'delete', 'label' => 'Удаление']);
        \App\Models\Permission::factory()->create(['name' => 'upload', 'label' => 'Загрузка файлов']);

    }
}
