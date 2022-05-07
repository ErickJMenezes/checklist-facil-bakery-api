<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CakesController\CakeSubscriptionStoreRequest;
use App\Jobs\ProcessCakeSubscription;
use App\Models\Cake;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class CakeSubscriptionsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\CakesController\CakeSubscriptionStoreRequest $request
     * @param \App\Models\Cake                                                       $cake
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OA\Post(
        path: '/cakes/{id}/subscriptions',
        operationId: 'createCakeSubscription',
        description: 'Cria uma nova inscrição para o bolo',
        summary: 'Cria uma nova inscrição para o bolo',
        requestBody: new OA\RequestBody(ref: '#/components/requestBodies/CakeSubscriptionStoreRequest'),
        tags: ['Bolos'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID do bolo',
                in: 'path',
                required: true,
            )
        ],
        responses: [
            new OA\Response(
                response: 202,
                description: 'Solicitação de bolo em processamento.',
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: 'message',
                                description: 'Mensagem de sucesso.',
                                type: 'string',
                            )
                        ],
                        type: 'object'
                    )
                )
            ),
            new OA\Response(
                ref: '#/components/responses/UnprocessableEntity',
                response: 422,
            ),
            new OA\Response(
                response: 429,
                description: 'Número de solicitações de bolo por minuto excedido.',
            )
        ]
    )]
    public function store(CakeSubscriptionStoreRequest $request, Cake $cake): JsonResponse
    {
        ProcessCakeSubscription::dispatchAfterResponse($cake, $request->email);

        return response()->json([
            'message' => trans('cake.successfullyRequested'),
        ], 202);
    }
}
