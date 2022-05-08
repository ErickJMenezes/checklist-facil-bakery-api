<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

// A rota "/swagger" é uma rota especial que é capturada pelo nginx, que por sua vez realiza o proxy_pass para o
// container do swagger-ui.
Route::get('/', fn () => redirect('/swagger'));

if (app()->environment('local')) {
    Route::get('/mails', fn () => redirect('http://localhost:8025'));
}
