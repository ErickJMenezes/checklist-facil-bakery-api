<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Unit\Listeners;

use App\Models\Cake;
use App\Models\CakeSubscription;
use App\Notifications\CakeIsAvailableNotification;
use App\Notifications\CakeOutOfStockNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class CheckCakeStockToNotifySubscribersTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Listeners\CheckCakeStockToNotifySubscribers
 */
class CheckCakeStockToNotifySubscribersTest extends TestCase
{
    public function test_it_must_notify_subscribers_that_new_cakes_are_available_to_buy(): void
    {
        Notification::fake();
        $cake = Cake::factory()
            ->has(
                CakeSubscription::factory()->count(3),
                'subscriptions',
            )
            ->createOneQuietly(['quantity' => 0]);
        $cake->update(['quantity' => 1]);
        Notification::assertTimesSent(3, CakeIsAvailableNotification::class);
    }

    public function test_it_must_notify_subscribers_that_the_cake_is_not_available_to_buy(): void
    {
        Notification::fake();
        $cake = Cake::factory()
            ->has(
                CakeSubscription::factory()->count(3),
                'subscriptions',
            )
            ->createOneQuietly(['quantity' => 1]);
        $cake->update(['quantity' => 0]);
        Notification::assertTimesSent(3, CakeOutOfStockNotification::class);
    }
}
