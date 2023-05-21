<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'car_type_id' => $this->car_type_id,
            'display_name' => ltrim($this->display_name),
            'key_name' => ltrim(strtolower($this->key_name))
        ];
    }
}
