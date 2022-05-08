<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\Cake;
use App\Models\CakeSubscription;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class CakesControllerTest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @covers \App\Http\Controllers\Api\V1\CakesController
 */
class CakesControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }

    public function test_index_must_return_the_paginated_collection_of_cakes(): void
    {
        Cake::factory(10)->create();
        $this->getJson(route('api.v1.cakes.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'price',
                        'quantity',
                        'created_at',
                        'updated_at',
                        'subscriptions' => [
                            '*' => [
                                'id',
                                'email',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }

    public function test_show_must_return_the_expected_resource(): void
    {
        $cake = Cake::factory()->create();
        $this->getJson(route('api.v1.cakes.show', $cake->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'price',
                'quantity',
                'created_at',
                'updated_at',
                'subscriptions' => [
                    '*' => [
                        'id',
                        'email',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function test_show_must_return_404_when_the_resource_does_not_exists(): void
    {
        $this->getJson(route('api.v1.cakes.show', 999999))
            ->assertStatus(404);
    }

    public function test_store_must_create_the_resource_with_no_errors(): void
    {
        $this->postJson(
            route('api.v1.cakes.store'),
            [
                'name' => 'Bolo de Chocolate',
                'price' => 10.00,
                'quantity' => 10,
                'weight_in_grams' => 1000,
            ],
        )
            ->assertStatus(201);
    }

    public function test_store_must_return_validation_errors(): void
    {
        $this->postJson(
            route('api.v1.cakes.store'),
            [
                'name' => 123,
            ]
        )
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'price',
                'quantity',
                'weight_in_grams',
            ]);
    }

    public function test_update_must_return_the_updated_resource_when_the_update_action_was_performed(): void
    {
        $cake = Cake::factory()->create();
        $this->patchJson(
            route('api.v1.cakes.update', $cake->id),
            [
                'name' => 'Bolo de Chocolate',
                'price' => 10.00,
                'quantity' => 10,
                'weight_in_grams' => 1000,
            ]
        )
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'price',
                'quantity',
                'created_at',
                'updated_at',
                'subscriptions',
            ]);
    }

    public function test_update_must_return_validation_errors_when_the_given_data_is_invalid(): void
    {
        $cake = Cake::factory()->create();
        $this->patchJson(
            route('api.v1.cakes.update', $cake->id),
            [
                'name' => 123,
            ]
        )
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name',
                ]
            ]);
    }

    public function test_update_must_return_404_when_the_cake_does_not_exists(): void
    {
        $this->patchJson(
            route('api.v1.cakes.update', 999999),
            Cake::factory(1)->make()->only(['name', 'price', 'quantity'])->toArray()
        )
            ->assertStatus(404);
    }

    public function test_destroy_must_return_200_when_the_resource_was_deleted(): void
    {
        $cake = Cake::factory()->create();
        $this->deleteJson(route('api.v1.cakes.destroy', $cake->id))
            ->assertStatus(200);
    }

    public function test_destroy_must_return_200_when_the_resource_was_deleted_with_subscribers(): void
    {
        $cake = Cake::factory()
            ->has(CakeSubscription::factory()->count(2), 'subscriptions')
            ->create();
        $this->deleteJson(route('api.v1.cakes.destroy', $cake->id))
            ->assertStatus(200);
    }

    public function test_destroy_must_return_404_when_the_resource_does_not_exists(): void
    {
        $this->deleteJson(route('api.v1.cakes.destroy', 999999))
            ->assertStatus(404);
    }
}
