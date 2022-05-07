<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Listeners;

use App\Events\UserSubscribedToCake;
use App\Notifications\CakeOutOfStockNotification;
use App\Notifications\CakeIsAvailableNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class NotifyCakeAvailability.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
class NotifyCakeAvailability implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\UserSubscribedToCake $event
     *
     * @return void
     */
    public function handle(UserSubscribedToCake $event): void
    {
        $cake = $event->subscription->load('cake')->cake;

        if ($cake->quantity > 0) {
            $event->subscription->notify(new CakeIsAvailableNotification(
                $cake->name,
                $cake->price,
            ));
        } else {
            $event->subscription->notify(new CakeOutOfStockNotification($cake->name));
        }
    }
}
