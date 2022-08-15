<?php

namespace App\Http\Resources\V1\Spells;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SpellCardDeckCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'current_page' => $this->currentPage(),
            'from' => $this->firstItem(),
            'per_page' => $this->perPage(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
            'data' => SpellCardDeckResource::collection($this->collection),
        ];
    }
}
