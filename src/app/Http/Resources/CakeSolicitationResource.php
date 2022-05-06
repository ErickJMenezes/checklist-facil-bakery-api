<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * Class CakeSolicitationResource.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @mixin \App\Models\CakeSolicitation
 */
#[OA\Schema(
    title: 'CakeSolicitation',
    description: 'Cake Solicitation Model',
    properties: [
        new OA\Property(
            property: 'id',
            description: 'Cake Solicitation ID',
            type: 'integer',
            format: 'int64',
            example: 1,
        ),
        new OA\Property(
            property: 'email',
            description: 'Cake Solicitation Email',
            type: 'string',
            example: 'foo@example.com',
        ),
    ],
    type: 'object'
)]
class CakeSolicitationResource extends JsonResource
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
        ];
    }
}
