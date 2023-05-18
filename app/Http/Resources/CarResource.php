<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public static $wrap = 'cars';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'car_type_id' => $this->car_type,
            'display_name' => ltrim($this->title),
            'key_name' => ltrim(strtolower($this->value))
        ];
    }
}
