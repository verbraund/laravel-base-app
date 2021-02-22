<?php

namespace App\Providers;

use App\Extensions\JwtGuard;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Contracts\Api\Auth\Token\Refresh;
use App\Contracts\Api\Auth\Token\Access;
use App\Extensions\AdminProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         \App\Models\Media\News\News::class => \App\Policies\Media\News\NewsPolicy::class,
         //\App\Models\User::class => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('admin', function($app){
            return new AdminProvider(
                $app[HasherContract::class],
                User::class
            );
        });

        Auth::extend('jwt', function ($app, $name, array $config) {
            return new JwtGuard(
                Auth::createUserProvider($config['provider']),
                $app['request'],
                $app[Access::class],
                $app[Refresh::class],
                JwtGuard::parseType($name)
            );
        });
    }
}
