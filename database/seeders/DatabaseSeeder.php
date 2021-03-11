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
            AdminAuthSeeder::class,
            //PermissionSeeder::class,
            //ResourceSeeder::class,
            //RoleSeeder::class,
            //UserSeeder::class,
            NewsCategorySeeder::class,
            //AdminMenuSeeder::class,
            //NewsSeeder::class,
        ]);
    }
}
