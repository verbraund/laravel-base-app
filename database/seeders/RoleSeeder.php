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

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->count(1), 'users')
            ->create(['name' => \App\Models\Role::SUPER_ADMIN_NAME]);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->count(2), 'users')
            ->create(['name' => \App\Models\Role::ADMIN_NAME]);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->count(3), 'users')
            ->create(['name' => 'Manager']);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->count(6),'users')
            ->create(['name' => 'User']);
    }
}
