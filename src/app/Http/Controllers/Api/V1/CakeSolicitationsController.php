<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cake;
use App\Models\CakeSolicitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'CakeSolicitationCollectionResponse',
    description: 'Lista de solicitações de bolos',
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
                                new OA\Schema(ref: '#/components/schemas/CakeSolicitationResource'),
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
    response: 'CakeSolicitationResponse',
    description: 'Solicitações de bolos',
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
                    new OA\Schema(ref: '#/components/schemas/CakeSolicitationResource'),
                ]
            )
        )
    ]
)]
class CakeSolicitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Cake $cake
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Cake $cake): JsonResponse
    {
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cake         $cake
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Cake $cake): JsonResponse
    {
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cake             $cake
     * @param \App\Models\CakeSolicitation $cakeSolicitation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Cake $cake, CakeSolicitation $cakeSolicitation): JsonResponse
    {
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cake             $cake
     * @param \App\Models\CakeSolicitation $cakeSolicitation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Cake $cake, CakeSolicitation $cakeSolicitation): JsonResponse
    {
        return response()->json();
    }
}
