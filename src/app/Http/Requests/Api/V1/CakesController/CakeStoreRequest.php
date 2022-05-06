<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Http\Requests\Api\V1\CakesController;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

/**
 * Class CakeStoreRequest.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
#[OA\RequestBody(
    request: 'CakeStoreRequest',
    description: 'Exemplo de payload para criar um novo bolo.',
    required: true,
    content: new OA\JsonContent(
        ref: '#/components/schemas/CakeUpdateOrStoreRequestPayload',
        example: [
            'name' => 'Bolo de Chocolate',
            'weight_in_grams' => 1200,
            'price' => 120.00,
            'quantity' => 30,
        ]
    )
)]
#[OA\Schema(
    schema: 'CakeUpdateOrStoreRequestPayload',
    properties: [
        new OA\Property(
            property: 'name',
            title: 'name',
            type: 'string',
            format: 'string',
            example: 'Bolo de Chocolate',
        ),
        new OA\Property(
            property: 'price',
            title: 'price',
            type: 'float',
            format: 'float',
            example: 5.00,
        ),
        new OA\Property(
            property: 'weight_in_grams',
            title: 'weight_in_grams',
            type: 'int',
            format: 'int32',
            example: 500,
        ),
        new OA\Property(
            property: 'quantity',
            title: 'quantity',
            type: 'int',
            format: 'int32',
            example: 1,
        ),
    ],
    type: 'object'
)]
class CakeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'weight_in_grams' => 'required|numeric',
            'quantity' => 'required|integer',
        ];
    }
}
