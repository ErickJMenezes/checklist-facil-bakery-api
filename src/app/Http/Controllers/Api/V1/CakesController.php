<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CakeSolicitationResource;
use App\Models\Cake;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CakesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: '/cakes',
        operationId: 'getCakes',
        description: 'Obtém todos os bolos disponíveis.',
        parameters: [
            new OA\Parameter(
                parameter: 'name',
                name: 'name',
                description: 'Filtra bolos onde contém o nome informado.',
                in: 'query',
                schema: new OA\Schema(
                    type: 'string'
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista de bolos',
                content: [
                    new OA\MediaType(
                        mediaType: 'Appplication/json',
                        example: [
                            'data' => [
                                [
                                    'name' => 'Bolo de Chocolate',
                                    'weightInGrams' => 1200,
                                    'price' => 120.00,
                                    'quantity' => 30,
                                ]
                            ]
                        ]
                    )
                ]
            )
        ]
    )]
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: '/cakes',
        operationId: 'createCake',
        description: 'Obtém todos os bolos disponíveis.',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                example: [
                    'name' => 'Bolo de Chocolate',
                    'weight_in_grams' => 1200,
                    'price' => 120.00,
                    'quantity' => 30,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Cadastrado com sucesso',
            ),
            new OA\Response(
                response: 422,
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
            )
        ]
    )]
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function show(Cake $cake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cake $cake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cake $cake)
    {
        //
    }
}
