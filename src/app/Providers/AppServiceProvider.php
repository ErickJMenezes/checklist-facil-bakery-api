<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'Microserviço para cadastro de bolos e envio de emails.',
    title: 'Checklist Fácil Bolos API',
)]
#[OA\Server(
    url: 'https://localhost/api',
    description: 'API base url'
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
        //
    }
}
