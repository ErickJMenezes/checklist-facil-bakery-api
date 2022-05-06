<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

use App\Http\Controllers\Api\V1\CakesController;
use App\Http\Controllers\Api\V1\CakeSolicitationsController;
use App\Http\Controllers\Api\V1\SwaggerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::name('v1.')->prefix('v1')->group(function () {
    Route::get('/swagger', SwaggerController::class)->name('swagger');

    Route::apiResource('cakes', CakesController::class);

    Route::apiResource('cakes.solicitations', CakeSolicitationsController::class)
        ->only(['store'])
        ->middleware('throttle:1000,1');
});
