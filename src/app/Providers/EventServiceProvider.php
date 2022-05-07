<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Providers;

use App\Events\CakeStockUpdated;
use App\Events\UserSubscribedToCake;
use App\Listeners\CheckCakeStockToNotifySubscribers;
use App\Listeners\NotifyCakeAvailability;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserSubscribedToCake::class => [
            NotifyCakeAvailability::class,
        ],
        CakeStockUpdated::class => [
            CheckCakeStockToNotifySubscribers::class,
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

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
