<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Observers;

use App\Events\UserSubscribedToCake;
use App\Models\CakeSubscription;

/**
 * Class CakeSubscriptionObserver.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
class CakeSubscriptionObserver
{
    public function created(CakeSubscription $cakeSubscription): void
    {
        event(new UserSubscribedToCake($cakeSubscription));
    }
}
