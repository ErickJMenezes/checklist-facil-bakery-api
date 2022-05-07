<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Listeners;

use App\Events\CakeStockUpdated;
use App\Models\Cake;
use App\Notifications\CakeIsAvailableNotification;
use App\Notifications\CakeOutOfStockNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Bus;

/**
 * Class CheckCakeStockToNotifySubscribers.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
class CheckCakeStockToNotifySubscribers implements ShouldQueue
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
     * @param \App\Events\CakeStockUpdated $event
     *
     * @return void
     */
    public function handle(CakeStockUpdated $event): void
    {
        $event->cake->load('subscriptions');

        // Notificaremos os assinantes caso o estoque estiver vazio, ou novos entraram no estoque.
        if ($event->oldStock === 0 && $event->newStock > 0) {
            $this->notifySubscribersThatNewCakesAreAvailableToBuy($event->cake);
        } elseif ($event->newStock === 0) {
            $this->notifySubscribersThatThisCakeIsOutOfStock($event->cake);
        }
    }

    private function notifySubscribersThatNewCakesAreAvailableToBuy(Cake $cake): void
    {
        $cake->subscriptions->each->notify(new CakeIsAvailableNotification(
            $cake->name,
            $cake->price,
        ));
    }

    private function notifySubscribersThatThisCakeIsOutOfStock(Cake $cake): void
    {
        $cake->subscriptions->each->notify(new CakeOutOfStockNotification($cake->name));
    }
}
