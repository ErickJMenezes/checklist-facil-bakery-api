<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * Class CakeSubscriptionResource.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @mixin \App\Models\CakeSubscription
 */
#[OA\Schema(
    schema: 'CakeSubscriptionResource',
    title: 'CakeSolicitation',
    description: 'Cake Solicitation Model',
    properties: [
        new OA\Property(
            property: 'email',
            description: 'Cake Solicitation Email',
            type: 'string',
            example: 'foo@example.com',
        ),
        new OA\Property(
            property: 'created_at',
            title: 'created_at',
            type: 'string',
            format: 'date-time-tz',
            example: '2020-01-01T00:00:00.000000Z',
        ),
        new OA\Property(
            property: 'updated_at',
            title: 'updated_at',
            type: 'string',
            format: 'date-time-tz',
            example: '2020-01-01T00:00:00.000000Z',
        ),
    ],
    type: 'object'
)]
class CakeSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
