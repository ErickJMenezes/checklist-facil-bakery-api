<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CakesController\CakeSolicitationsStoreRequest;
use App\Jobs\ProcessCakeSolicitation;
use App\Models\Cake;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class CakeSolicitationsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\CakesController\CakeSolicitationsStoreRequest $request
     * @param \App\Models\Cake                                                        $cake
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OA\Post(
        path: '/cakes/{id}/solicitations',
        operationId: 'createCakeSolicitation',
        description: 'Cria uma nova solicitação de bolo',
        summary: 'Cria uma nova solicitação de bolo',
        requestBody: new OA\RequestBody(ref: '#/components/requestBodies/CakeSolicitationsStoreRequest'),
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
    public function store(CakeSolicitationsStoreRequest $request, Cake $cake): JsonResponse
    {
        ProcessCakeSolicitation::dispatchAfterResponse($cake, $request->email);

        return response()->json([
            'message' => trans('cake.successfullyRequested'),
        ], 202);
    }
}
