<?php

namespace App\Http\Resources\Produit;

use App\Http\Resources\User\UserResource;
use App\Http\Resources\OrigineResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProduitUserResource extends JsonResource
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
            'id'         => $this->id,
            'libelle'    => $this->libelle,
            'description'=> $this->description,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'origines'   => OrigineResource::collection($this->origines),
            'user'       => new UserResource($this->user),
        ];  
    }
}
