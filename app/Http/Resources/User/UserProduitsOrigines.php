<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Produit\ProduitResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProduitsOrigines extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'email'    => $this->email,
            'produits' => ProduitResource::collection($this->produits),
        ];  
    }
}
