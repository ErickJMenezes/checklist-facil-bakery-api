<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Jobs\ProcessCakeSubscription;
use App\Models\Cake;
use App\Models\CakeSubscription;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class CakeSolicitationsControllerTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Http\Controllers\Api\V1\CakeSubscriptionsController
 */
class CakeSubscriptionsControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
        Bus::fake();
    }

    public function test_store_must_return_validation_errors(): void
    {
        $cake = Cake::factory()->create();

        $this->postJson(route('api.v1.cakes.subscriptions.store', $cake->id), [
                'email' => 'fooemail'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_store_must_accept_the_payload(): void
    {
        $cake = Cake::factory()->create();

        $this->postJson(route('api.v1.cakes.subscriptions.store', $cake->id), [
            'email' => $this->faker->email
        ])
            ->assertStatus(202)
            ->assertJson([
                'message' => trans('cake.successfullyRequested')
            ]);

        Bus::assertDispatched(ProcessCakeSubscription::class);
    }

    public function test_destroy_must_remove_the_subscription_from_the_cake(): void
    {
        $cake = Cake::factory()
            ->has(CakeSubscription::factory()->count(1), 'subscriptions')
            ->create()
            ->load('subscriptions');

        $this->deleteJson(route(
            'api.v1.cakes.subscriptions.destroy',
            [$cake->id, $cake->subscriptions->first()->id]
        ))
            ->assertStatus(200)
            ->assertJsonStructure(['message']);
    }

    public function test_destroy_must_return_404_when_the_subscription_is_found_but_does_not_belongs_to_the_cake(): void
    {
        $cake1 = Cake::factory()
            ->has(CakeSubscription::factory()->count(1), 'subscriptions')
            ->create()
            ->load('subscriptions');
        $cake2 = Cake::factory()->create();

        $this->deleteJson(route(
            'api.v1.cakes.subscriptions.destroy',
            [$cake2->id, $cake1->subscriptions->first()->id]
        ))
            ->assertStatus(404);
    }
}
