<?php

namespace App\Providers;

use App\Events\ForgotTFACode;
use App\Events\HappenedException;
use App\Listeners\SendHttpExceptionNotification;
use App\Listeners\SendErrorExceptionNotification;
use App\Listeners\SendTFACodeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ForgotTFACode::class => [ SendTFACodeNotification::class],
        HappenedException::class => [
            SendHttpExceptionNotification::class,
            SendErrorExceptionNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
