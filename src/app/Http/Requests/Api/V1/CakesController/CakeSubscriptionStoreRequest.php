<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Http\Requests\Api\V1\CakesController;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CakeSubscriptionStoreRequestPayload',
    properties: [
        new OA\Property(
            property: 'email',
            description: 'O e-mail do usuário que solicita o bolo',
            type: 'string',
            format: 'email',
        )
    ],
    type: 'object',
)]
#[OA\RequestBody(
    request: 'CakeSubscriptionStoreRequest',
    description: 'Solicitação de bolo',
    required: true,
    content: new OA\JsonContent(
        ref: '#/components/schemas/CakeSubscriptionStoreRequestPayload',
        example: [
            'email' => 'foo@example.com'
        ]
    ),
)]
class CakeSubscriptionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'email' => 'required|email'
        ];
    }
}
