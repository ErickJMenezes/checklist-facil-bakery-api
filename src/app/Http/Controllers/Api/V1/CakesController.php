<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CakesController\CakeStoreRequest;
use App\Http\Requests\Api\V1\CakesController\CakeUpdateRequest;
use App\Http\Resources\CakeResource;
use App\Models\Cake;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    #[OA\Get(
        path: '/cakes',
        operationId: 'getCakes',
        description: 'Obtém todos os bolos disponíveis paginados.',
        summary: 'Obtém todos os bolos disponíveis paginados.',
        tags: ['Bolos'],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CakeItemCollectionResponse',
                response: 200
            )
        ]
    )]
    public function index(): AnonymousResourceCollection
    {
        return CakeResource::collection(Cake::with('solicitations')->paginate(20));
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
        description: 'Cria um novo bolo',
        summary: 'Cria um novo bolo',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CakeStoreRequest'
        ),
        tags: ['Bolos'],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CakeItemResponse',
                response: 201,
            ),
            new OA\Response(
                ref: '#/components/responses/UnprocessableEntity',
                response: 422
            )
        ]
    )]
    public function store(CakeStoreRequest $request): JsonResponse
    {
        $cake = Cake::create($request->validated());
        return CakeResource::make($cake)
            ->response()
            ->setStatusCode(201);
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
        summary: 'Obtém um bolo pelo ID.',
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
        $cake->load('solicitations');
        return CakeResource::make($cake)->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\CakesController\CakeUpdateRequest $request
     * @param \App\Models\Cake                                            $cake
     *
     * @return \App\Http\Resources\CakeResource
     */
    #[OA\Patch(
        path: '/cakes/{id}',
        operationId: 'updateCakeById',
        description: 'Atualiza um bolo pelo ID. Apenas os campos que forem enviados serão atualizados.',
        summary: 'Atualiza um bolo pelo ID. Apenas os campos que forem enviados serão atualizados.',
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
    public function update(CakeUpdateRequest $request, Cake $cake): CakeResource
    {
        DB::transaction(function () use ($request, &$cake) {
            $cake->lockForUpdate()->update($request->validated());
        });
        $cake->load('solicitations');
        $cake->refresh();
        return new CakeResource($cake);
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
        summary: 'Obtém um bolo pelo ID.',
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
        $cake->delete();
        return response()->json();
    }
}
