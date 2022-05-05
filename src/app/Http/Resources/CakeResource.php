<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CakeResource.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 * @mixin \App\Models\Cake
 */
class CakeResource extends JsonResource
{
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
            'name' => $this->name,
            'weight_in_grams' => $this->weight_in_grams,
            'price' => $this->price / 100,
            'quantity' => $this->quantity,
            'solicitations' => CakeSolicitationResource::collection($this->whenLoaded('solicitations'))
        ];
    }
}
