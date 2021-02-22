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
        \App\Models\Permission::factory()->create(['name' => 'viewAny']);
        \App\Models\Permission::factory()->create(['name' => 'view']);
        \App\Models\Permission::factory()->create(['name' => 'create']);
        \App\Models\Permission::factory()->create(['name' => 'update']);
        \App\Models\Permission::factory()->create(['name' => 'delete']);

    }
}
