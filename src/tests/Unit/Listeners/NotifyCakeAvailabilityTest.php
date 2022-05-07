<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Unit\Listeners;

use App\Events\UserSubscribedToCake;
use App\Listeners\NotifyCakeAvailability;
use App\Models\Cake;
use App\Notifications\CakeIsAvailableNotification;
use App\Notifications\CakeOutOfStockNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class NotifyCakeAvailabilityTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Listeners\NotifyCakeAvailability
 */
class NotifyCakeAvailabilityTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_it_must_notify_that_the_cake_is_available(): void
    {
        $event = Event::fakeFor(function () {
            $cake = Cake::factory()->create(['quantity' => 1]);
            $subscription = $cake->subscriptions()->create(['email' => $this->faker()->email]);
            return new UserSubscribedToCake($subscription);
        });
        Notification::fake();
        app(NotifyCakeAvailability::class)->handle($event);
        Notification::assertSentTo($event->subscription, CakeIsAvailableNotification::class);
    }

    public function test_it_must_notify_that_the_cake_is_unavailable(): void
    {
        $event = Event::fakeFor(function () {
            $cake = Cake::factory()->create(['quantity' => 0]);
            $subscription = $cake->subscriptions()->create(['email' => $this->faker()->email]);
            return new UserSubscribedToCake($subscription);
        });
        Notification::fake();
        app(NotifyCakeAvailability::class)->handle($event);
        Notification::assertSentTo($event->subscription, CakeOutOfStockNotification::class);
    }
}
