<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CakeSolicitationResource.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @mixin \App\Models\CakeSolicitation
 */
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
            'email' => $this->email,
        ];
    }
}
