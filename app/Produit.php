<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'libelle', 'description', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function origines()
    {
        return $this->hasMany(Origine::class);
    }
}
