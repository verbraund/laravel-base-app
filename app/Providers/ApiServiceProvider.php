<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Api\Auth\Token\Access::class, \App\Services\Api\Auth\JWTService::class);
        $this->app->bind(\App\Contracts\Api\Auth\Token\Refresh::class, \App\Services\Api\Auth\SimpleToken::class);
        $this->app->bind(\App\Contracts\Api\Auth\TFA::class, \App\Services\Api\Auth\GoogleAuthQrCode::class);

        $this->app->bind(\App\Contracts\Api\Media\News::class, \App\Services\Api\Media\NewsService::class);
        $this->app->bind(\App\Contracts\Api\Media\QueryFilters::class, \App\Services\Api\Media\QueryFiltersService::class);
//        $this->app->bind(\App\Contracts\Api\Media\QueryFilters::class, function(){
//            return new \App\Services\Api\Media\QueryFiltersService(
//                new \App\Services\Api\Media\SortService
//            );
//        });
        $this->app->bind( \App\Services\Api\Media\SortService::class);
        $this->app->bind( \App\Services\Api\Media\SearchService::class);
        $this->app->bind( \App\Services\Api\Media\PaginateService::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
