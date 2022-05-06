<?php

namespace App\Http\Requests\Api\V1\CakesController;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'CakeUpdateRequest',
    description: 'Exemplo de payload para atualizar um bolo.',
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
class CakeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255|nullable',
            'price' => 'numeric|nullable',
            'weight_in_grams' => 'numeric|nullable',
            'quantity' => 'integer|nullable',
        ];
    }
}
