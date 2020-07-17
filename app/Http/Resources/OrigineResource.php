<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrigineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'pays' => $this->pays,
            'ville'=> $this->ville,
            // 'created_at' => (string) $this->created_at,
        ];
    }
}
