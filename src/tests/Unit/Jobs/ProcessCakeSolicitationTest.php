<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ProcessCakeSolicitation;
use App\Models\Cake;
use App\Notifications\CakeOutOfStockNotification;
use App\Notifications\CakeRequestedNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class ProcessCakeSolicitationTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Jobs\ProcessCakeSolicitation
 */
class ProcessCakeSolicitationTest extends TestCase
{
    public function test_it_must_send_the_cake_requested_notification(): void
    {
        Notification::fake();
        $cake = Cake::factory()->create([
            'quantity' => 1,
        ]);
        $job = new ProcessCakeSolicitation($cake, 'foo@bar.com');
        $job->handle();
        Notification::assertSentOnDemandTimes(CakeRequestedNotification::class);
    }

    public function test_it_must_send_the_cake_out_of_stock_notification(): void
    {
        Notification::fake();
        $cake = Cake::factory()->create([
            'quantity' => 0,
        ]);
        $job = new ProcessCakeSolicitation($cake, 'foo@bar.com');
        $job->handle();
        Notification::assertSentOnDemandTimes(CakeOutOfStockNotification::class);
    }
}
