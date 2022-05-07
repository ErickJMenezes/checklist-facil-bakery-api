<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Unit\Jobs;

use App\Events\UserSubscribedToCake;
use App\Jobs\ProcessCakeSubscription;
use App\Models\Cake;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class ProcessCakeSolicitationTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Jobs\ProcessCakeSubscription
 */
class ProcessCakeSolicitationTest extends TestCase
{
    public function test_it_must_subscribe_to_the_cake_if_doesnt(): void
    {
        Event::fake([
            UserSubscribedToCake::class,
        ]);
        $cake = Cake::factory()->create();
        $job = new ProcessCakeSubscription($cake, 'foo@bar.com');
        $job->handle();
        Event::assertDispatched(UserSubscribedToCake::class);
    }

    public function test_it_must_not_subscribe_to_the_cake_more_than_once(): void
    {
        Event::fake([
            UserSubscribedToCake::class,
        ]);
        $cake = Cake::factory()->create();
        (new ProcessCakeSubscription($cake, 'foo@bar.com'))->handle();
        (new ProcessCakeSubscription($cake, 'foo@bar.com'))->handle();
        Event::assertDispatchedTimes(UserSubscribedToCake::class, 1);
    }
}
