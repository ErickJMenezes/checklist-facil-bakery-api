<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Unit\Observers;

use App\Events\UserSubscribedToCake;
use App\Models\Cake;
use App\Observers\CakeSubscriptionObserver;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class CakeSubscriptionObserverTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Observers\CakeSubscriptionObserver
 */
class CakeSubscriptionObserverTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function test_events_must_be_fired_if_new_subscriptions_are_created(): void
    {
        Event::fake([UserSubscribedToCake::class]);
        $cake = Cake::factory()->createOneQuietly();
        $cake->subscriptions()->create(['email' => $this->faker->email]);
        Event::assertDispatched(UserSubscribedToCake::class);
    }
}
