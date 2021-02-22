<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            ResourceSeeder::class,
            RoleSeeder::class,
            //UserSeeder::class,
            NewsCategorySeeder::class,
            //NewsSeeder::class,
        ]);
    }
}
