<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\SwaggerController;
use Tests\TestCase;

class SwaggerControllerTest extends TestCase
{
    /**
     * @return void
     * @author ErickJMenezes <erickmenezes.dev@gmail.com>
     * @test
     * @covers \App\Http\Controllers\Api\V1\SwaggerController
     */
    public function itMustReturnTheOpenApiSpecInJsonFormat(): void
    {
        $this->getJson(route('v1.swagger'))
            ->assertDownload('swagger.json');
    }
}
