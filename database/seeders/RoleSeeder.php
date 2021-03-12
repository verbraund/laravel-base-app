<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Role::factory()->create(['name' => \App\Models\Role::SUPER_ADMIN_NAME]);
        \App\Models\Role::factory()->create(['name' => \App\Models\Role::ADMIN_NAME]);
        \App\Models\Role::factory()->create(['name' => \App\Models\Role::HTTP_EXCEPTION_NAME]);
        \App\Models\Role::factory()->create(['name' => \App\Models\Role::ERROR_EXCEPTION_NAME]);
        \App\Models\Role::factory()->create(['name' => 'Manager']);
        \App\Models\Role::factory()->create(['name' => 'User']);

    }
}
