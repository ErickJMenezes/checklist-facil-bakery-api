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
 * Class CakeResource.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @mixin \App\Models\Cake
 */
#[OA\Schema(
    schema: 'CakeResource',
    title: 'Cake',
    description: 'Cake model',
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
        new OA\Property(
            property: 'solicitations',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/CakeSolicitationResource'),
        ),
    ],
    type: 'object'
)]
class CakeResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'weight_in_grams' => $this->weight_in_grams,
            'price' => $this->price / 100,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'solicitations' => CakeSolicitationResource::collection($this->whenLoaded('solicitations')),
        ];
    }
}
