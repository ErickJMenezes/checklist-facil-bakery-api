<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Observers;

use App\Events\CakeStockUpdated;
use App\Models\Cake;

/**
 * Class CakeObserver.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
class CakeObserver
{
    /**
     * Handle the Cake "updated" event.
     *
     * @param  \App\Models\Cake  $cake
     * @return void
     */
    public function updated(Cake $cake): void
    {
        if ($cake->wasChanged('quantity')) {
            event(new CakeStockUpdated(
                $cake,
                $cake->getOriginal('quantity'),
                $cake->quantity
            ));
        }
    }
}
