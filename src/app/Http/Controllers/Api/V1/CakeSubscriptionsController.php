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
use App\Models\CakeSubscription;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

/**
 * Class CakeSubscriptionsController.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
#[OA\Response(
    response: 'ProcessingCakeSubscriptionResponse',
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
)]
#[OA\Response(
    response: 'CakeSubscriptionDeletedResponse',
    description: 'Inscrição removida com sucesso.',
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
)]
#[OA\Response(
    response: 'CakeSubscriptionNotFoundResponse',
    description: 'Inscrição não encontrada.',
    content: new OA\MediaType(
        mediaType: 'application/json',
        schema: new OA\Schema(
            properties: [
                new OA\Property(
                    property: 'message',
                    description: 'Mensagem de erro.',
                    type: 'string',
                )
            ],
            type: 'object'
        )
    )
)]
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
        path: '/cakes/{cake}/subscriptions',
        operationId: 'createCakeSubscription',
        description: 'Cria uma nova inscrição para o bolo',
        summary: 'Cria uma nova inscrição para o bolo',
        requestBody: new OA\RequestBody(ref: '#/components/requestBodies/CakeSubscriptionStoreRequest'),
        tags: ['Assinar bolos'],
        parameters: [
            new OA\Parameter(
                parameter: 'cake',
                name: 'cake',
                description: 'ID do bolo',
                in: 'path',
                required: true,
            )
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/ProcessingCakeSubscriptionResponse',
                response: 202,
            ),
            new OA\Response(
                ref: '#/components/responses/UnprocessableEntity',
                response: 422,
            ),
            new OA\Response(
                response: 404,
                description: 'Bolo não encontrado.',
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

    #[OA\Delete(
        path: '/cakes/{cake}/subscriptions/{subscription}',
        operationId: 'deleteCakeSubscription',
        description: 'Remove a inscrição para o bolo',
        summary: 'Remove a inscrição para o bolo',
        tags: ['Assinar bolos'],
        parameters: [
            new OA\Parameter(
                parameter: 'cake',
                name: 'cake',
                description: 'ID do bolo',
                in: 'path',
                required: true,
            ),
            new OA\Parameter(
                parameter: 'subscription',
                name: 'subscription',
                description: 'ID da inscrição',
                in: 'path',
                required: true,
            )
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CakeSubscriptionDeletedResponse',
                response: 200,
            ),
            new OA\Response(
                ref: '#/components/responses/CakeSubscriptionNotFoundResponse',
                response: 404,
            )
        ]
    )]
    public function destroy(int $cake, CakeSubscription $subscription): JsonResponse
    {
        if ($cake !== $subscription->cake_id) {
            return response()->json(status: 404);
        }

        // Aqui poderiamos disparar alguma ação utilizando os eventos de ciclo de vida do Model.
        $subscription->delete();

        return response()->json([
            'message' => 'A inscrição foi removida com sucesso.',
        ]);
    }
}
