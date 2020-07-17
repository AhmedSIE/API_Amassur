<?php

namespace App\Http\Controllers;

use App\Origine;
use App\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrigineResource;
use App\Http\Resources\Produit\ProduitUserResource;

class OrigineController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    
    public function index(Produit $produit)
    {
        return new ProduitUserResource($produit);
    }

    public function store(Request $request)
    {
        $produit = Produit::findOrFail($request->produit);
        if ($request->user()->id !== $produit->user->id) {
            return response()->json(['error' => 'Vous n est pas autorisés à ajouter l origine de ce produit.'], 403);
        }

        $origine = Origine::create([
            'produit_id' => $request->produit,
            'pays'       => $request->pays,
            'ville'      => $request->ville,
        ]);
        return new ProduitUserResource(Produit::findOrFail($request->produit));
    }

    public function show(Origine $origine)
    {
        return new OrigineResource($origine);
    }

    public function update(Request $request, Origine $origine)
    {
        if ($request->user()->id !== $origine->produit->user->id) {
            return response()->json(['error' => 'Vous n est pas autorisés à éditer l origine du produit.'], 403);
        }
        $origine->update($request->only(['pays', 'ville']));
        return new OrigineResource($origine);
    }

    public function destroy(Origine $origine)
    {
        $origine->delete();
        return response()->json(['message' => 'Origine de produit supprimé avec succes !.'], 403);
    }

   
}
