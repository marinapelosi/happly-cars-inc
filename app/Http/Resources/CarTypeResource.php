<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarTypeResource extends JsonResource
{
    public static $wrap = 'car_types';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'display_name' => $this->title,
            'key_name' => strtolower($this->value)
        ];
    }
}
