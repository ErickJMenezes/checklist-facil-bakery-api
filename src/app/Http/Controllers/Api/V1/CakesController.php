<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CakesController\CakeStoreRequest;
use App\Http\Requests\Api\V1\CakesController\CakeUpdateRequest;
use App\Models\Cake;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

/**
 * Class CakesController.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
#[OA\Response(
    response: 'CakeItemCollectionResponse',
    description: 'Lista de bolos',
    content: [
        new OA\MediaType(
            mediaType: 'Appplication/json',
            schema: new OA\Schema(
                properties: [
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(
                            allOf: [
                                new OA\Schema(
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            title: 'id',
                                            type: 'int',
                                            format: 'int64',
                                            example: 1,
                                        ),
                                    ]
                                ),
                                new OA\Schema(ref: '#/components/schemas/CakeResource'),
                            ]
                        ),
                    ),
                    new OA\Property(
                        property: 'links',
                        ref: '#/components/schemas/PaginationLinks',
                    ),
                    new OA\Property(
                        property: 'meta',
                        ref: '#/components/schemas/PaginationMeta',
                    )
                ],
                type: 'object',
            )
        )
    ]
)]
#[OA\Response(
    response: 'CakeItemResponse',
    description: 'Bolo',
    content: [
        new OA\MediaType(
            mediaType: 'Appplication/json',
            schema: new OA\Schema(
                type: 'object',
                allOf: [
                    new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: 'id',
                                title: 'id',
                                type: 'int',
                                format: 'int64',
                                example: 1,
                            ),
                        ]
                    ),
                    new OA\Schema(ref: '#/components/schemas/CakeResource'),
                ]
            )
        )
    ]
)]
class CakesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OA\Get(
        path: '/cakes',
        operationId: 'getCakes',
        description: 'Obtém todos os bolos disponíveis.',
        tags: ['Bolos'],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CakeItemCollectionResponse',
                response: 200
            )
        ]
    )]
    public function index(): JsonResponse
    {
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\CakesController\CakeStoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OA\Post(
        path: '/cakes',
        operationId: 'createCake',
        description: 'Obtém todos os bolos disponíveis.',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CakeStoreRequest'
        ),
        tags: ['Bolos'],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CakeItemResponse',
                response: 202,
            ),
            new OA\Response(
                ref: '#/components/responses/UnprocessableEntity',
                response: 422
            )
        ]
    )]
    public function store(CakeStoreRequest $request): JsonResponse
    {
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cake $cake
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OA\Get(
        path: '/cakes/{id}',
        operationId: 'getCakeById',
        description: 'Obtém um bolo pelo ID.',
        tags: ['Bolos'],
        parameters: [
            new OA\Parameter(
                parameter: 'id',
                name: 'id',
                description: 'ID do bolo.',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64'
                )
            )
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CakeItemResponse',
                response: 200,
            ),
            new OA\Response(
                response: 404,
                description: 'Bolo não encontrado',
            )
        ]
    )]
    public function show(Cake $cake): JsonResponse
    {
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\CakesController\CakeUpdateRequest $request
     * @param \App\Models\Cake                                            $cake
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OA\Patch(
        path: '/cakes/{id}',
        operationId: 'updateCakeById',
        description: 'Atualiza um bolo pelo ID.',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CakeUpdateRequest'
        ),
        tags: ['Bolos'],
        parameters: [
            new OA\Parameter(
                parameter: 'id',
                name: 'id',
                description: 'ID do bolo.',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64'
                )
            ),
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CakeItemResponse',
                response: 200,
                description: 'Bolo atualizado',
            ),
            new OA\Response(
                response: 404,
                description: 'Bolo não encontrado',
            ),
            new OA\Response(
                ref: '#/components/responses/UnprocessableEntity',
                response: 422,
            )
        ]
    )]
    public function update(CakeUpdateRequest $request, Cake $cake): JsonResponse
    {
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cake $cake
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OA\Delete(
        path: '/cakes/{id}',
        operationId: 'deleteCakeById',
        description: 'Obtém um bolo pelo ID.',
        tags: ['Bolos'],
        parameters: [
            new OA\Parameter(
                parameter: 'id',
                name: 'id',
                description: 'ID do bolo.',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64'
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Bolo deletado',
            ),
            new OA\Response(
                response: 404,
                description: 'Bolo não encontrado',
            )
        ]
    )]
    public function destroy(Cake $cake): JsonResponse
    {
        return response()->json();
    }
}
