<?php

namespace App\Http\Resources\V1\Infection;

use Illuminate\Http\Resources\Json\JsonResource;

class InfectionCardDeckResource extends JsonResource
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
            'infection' => $this->infection,
            'room' => $this->room,
            'user' => $this->user,
            'status' => $this->status,
        ];
    }
}
