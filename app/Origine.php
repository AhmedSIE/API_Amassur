<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origine extends Model
{
    protected $fillable = [
        'pays', 'ville', 'produit_id',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
