<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

use App\Http\Controllers\Api\V1\CakesController;
use App\Http\Controllers\Api\V1\CakeSubscriptionsController;
use App\Http\Controllers\Api\V1\SwaggerController;
use Illuminate\Support\Facades\Route;

Route::name('v1.')->prefix('v1')->group(function () {
    Route::get('/swagger', SwaggerController::class)->name('swagger');

    Route::apiResource('cakes', CakesController::class);

    Route::apiResource('cakes.subscriptions', CakeSubscriptionsController::class)
        ->only(['store', 'destroy']);
});
