<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Unit\Observers;

use App\Events\CakeStockUpdated;
use App\Models\Cake;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class CakeObserverTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Observers\CakeObserver
 */
class CakeObserverTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_must_fire_the_cake_stock_updated_event_whenever_the_cake_stock_is_updated(): void
    {
        Event::fake([CakeStockUpdated::class]);
        $cake = Cake::factory()->createOneQuietly();
        $cake->update(['quantity' => 10]);
        Event::assertDispatchedTimes(CakeStockUpdated::class);
    }

    public function test_it_must_not_fire_the_cake_stock_updated_event_when_quantity_is_not_updated(): void
    {
        Event::fake([CakeStockUpdated::class]);
        $cake = Cake::factory()->createOneQuietly();
        $cake->update(['name' => 'foo']);
        Event::assertNotDispatched(CakeStockUpdated::class);
    }
}
