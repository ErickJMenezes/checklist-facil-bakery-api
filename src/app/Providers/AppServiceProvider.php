<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Providers;

use App\Models\Cake;
use App\Models\CakeSubscription;
use App\Observers\CakeObserver;
use App\Observers\CakeSubscriptionObserver;
use Illuminate\Support\ServiceProvider;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'Microserviço para crud de bolos e envio de emails para solicitantes.',
    title: 'Checklist Fácil - API Bolos',
)]
#[OA\Server(
    url: 'http://localhost/api/v1/',
    description: 'URL base da API'
)]
#[OA\Response(
    response: 'UnprocessableEntity',
    description: 'Erros de validação',
    content: [
        new OA\MediaType(
            mediaType: 'Appplication/json',
            example: [
                'message' => 'The error message',
                'errors' => [
                    'field_name' => [
                        'Validation error message.'
                    ],
                ]
            ]
        )
    ]
)]
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initModelObservers();
    }

    private function initModelObservers(): void
    {
        CakeSubscription::observe(CakeSubscriptionObserver::class);
        Cake::observe(CakeObserver::class);
    }
}
