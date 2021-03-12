<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ///// RESOURCES
        $newsResource = \App\Models\Resource::factory()->create(['name' => \App\Models\Media\News\News::class, 'label' => 'Новости']);
        $newsCategoriesResource = \App\Models\Resource::factory()->create(['name' => \App\Models\Media\News\NewsCategory::class, 'label' => 'Категории новостей']);
        $userResource = \App\Models\Resource::factory()->create(['name' => \App\Models\User::class, 'label' => 'Пользователи']);
        $roleResource = \App\Models\Resource::factory()->create(['name' => \App\Models\Role::class, 'label' => 'Роли пользователей']);


        ///// PERMISSIONS
        $viewPermission = \App\Models\Permission::factory()->create(['name' => 'view', 'label' => 'Просмотр']);
        $createPermission = \App\Models\Permission::factory()->create(['name' => 'create', 'label' => 'Создение']);
        $updatePermission = \App\Models\Permission::factory()->create(['name' => 'update', 'label' => 'Изминение']);
        $deletePermission = \App\Models\Permission::factory()->create(['name' => 'delete', 'label' => 'Удаление']);
        $uploadPermission = \App\Models\Permission::factory()->create(['name' => 'upload', 'label' => 'Загрузка файлов']);



        ///// USER ROLES
        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->state(['login' => 'admin'])->count(1))
            ->hasAttached($newsResource,['permission_id' => $viewPermission->id])
            ->hasAttached($newsResource,['permission_id' => $createPermission->id])
            ->hasAttached($newsResource,['permission_id' => $updatePermission->id])
            ->hasAttached($newsResource,['permission_id' => $deletePermission->id])
            ->hasAttached($newsResource,['permission_id' => $uploadPermission->id])

            ->hasAttached($newsCategoriesResource,['permission_id' => $viewPermission->id])
            ->hasAttached($newsCategoriesResource,['permission_id' => $createPermission->id])
            ->hasAttached($newsCategoriesResource,['permission_id' => $updatePermission->id])
            ->hasAttached($newsCategoriesResource,['permission_id' => $deletePermission->id])

            ->hasAttached($userResource,['permission_id' => $viewPermission->id])
            ->hasAttached($userResource,['permission_id' => $createPermission->id])
            ->hasAttached($userResource,['permission_id' => $updatePermission->id])
            ->hasAttached($userResource,['permission_id' => $deletePermission->id])
            ->hasAttached($userResource,['permission_id' => $uploadPermission->id])

            ->hasAttached($roleResource,['permission_id' => $viewPermission->id])
            ->hasAttached($roleResource,['permission_id' => $createPermission->id])
            ->hasAttached($roleResource,['permission_id' => $updatePermission->id])
            ->hasAttached($roleResource,['permission_id' => $deletePermission->id])

            ->create(['name' => \App\Models\Role::SUPER_ADMIN_NAME]);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->count(2), 'users')
            ->hasAttached($newsResource,['permission_id' => $viewPermission->id])
            ->hasAttached($newsResource,['permission_id' => $createPermission->id])
            ->hasAttached($newsResource,['permission_id' => $updatePermission->id])
            ->hasAttached($newsResource,['permission_id' => $deletePermission->id])

            ->hasAttached($newsCategoriesResource,['permission_id' => $viewPermission->id])
            ->hasAttached($newsCategoriesResource,['permission_id' => $createPermission->id])
            ->hasAttached($newsCategoriesResource,['permission_id' => $updatePermission->id])
            ->hasAttached($newsCategoriesResource,['permission_id' => $deletePermission->id])
            ->create(['name' => \App\Models\Role::ADMIN_NAME]);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->count(3), 'users')
            ->create(['name' => 'Manager']);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->count(6),'users')
            ->create(['name' => 'User']);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->state([
                'login' => 'HttpExceptionRobot',
                'password' => null,
            ]), 'users')
            ->create(['name' => \App\Models\Role::HTTP_EXCEPTION_NAME]);

        \App\Models\Role::factory()
            ->has(\App\Models\User::factory()->state([
                'login' => 'ErrorExceptionRobot',
                'password' => null,
            ]), 'users')
            ->create(['name' => \App\Models\Role::ERROR_EXCEPTION_NAME]);



        ///// ADMIN MENU
        $newsParent = \App\Models\Admin\Menu::factory()->create(['name' => 'Новости']);
        \App\Models\Admin\Menu::factory()
            ->for($newsParent, 'parents')
            ->for($newsResource, 'resource')
            ->create([
                'name' => 'Новости',
                'urn' => '/admin/news'
            ]);
        \App\Models\Admin\Menu::factory()
            ->for($newsParent, 'parents')
            ->for($newsCategoriesResource, 'resource')
            ->create([
                'name' => 'Категории',
                'urn' => '/admin/news/categories'
            ]);

        $usersParent = \App\Models\Admin\Menu::factory()->create(['name' => 'Пользователи']);
        \App\Models\Admin\Menu::factory()
            ->for($usersParent, 'parents')
            ->for($userResource, 'resource')
            ->create([
            'name' => 'Пользователи',
            'urn' => '/admin/users'
        ]);
        \App\Models\Admin\Menu::factory()
            ->for($usersParent, 'parents')
            ->for($roleResource, 'resource')
            ->create([
            'name' => 'Роли',
            'urn' => '/admin/roles'
        ]);


    }
}
