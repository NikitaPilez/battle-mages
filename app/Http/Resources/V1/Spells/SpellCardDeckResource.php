<?php

namespace App\Http\Resources\V1\Spells;

use Illuminate\Http\Resources\Json\JsonResource;

class SpellCardDeckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'spell' => $this->spell,
            'room' => $this->room,
            'user' => $this->user,
            'status' => $this->status,
        ];
    }
}
