<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Jobs\ProcessCakeSolicitation;
use App\Models\Cake;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

/**
 * Class CakeSolicitationsControllerTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Http\Controllers\Api\V1\CakeSolicitationsController
 */
class CakeSolicitationsControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_store_must_return_validation_errors(): void
    {
        $cake = Cake::factory()->create();

        $this->postJson(route('api.v1.cakes.solicitations.store', $cake->id), [
                'email' => 'fooemail'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_store_must_accept_the_payload(): void
    {
        Bus::fake([
            ProcessCakeSolicitation::class
        ]);

        $cake = Cake::factory()->create();

        $this->postJson(route('api.v1.cakes.solicitations.store', $cake->id), [
            'email' => $this->faker->email
        ])
            ->assertStatus(202)
            ->assertJson([
                'message' => trans('cake.successfullyRequested')
            ]);

        Bus::assertDispatched(ProcessCakeSolicitation::class);
    }
}
