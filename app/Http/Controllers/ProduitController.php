<?php

namespace App\Http\Controllers;

use App\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Produit\ProduitResource;

class ProduitController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    public function index()
    {
        return ProduitResource::collection(Produit::with('origines')->paginate(25));
    }

    public function store(Request $request)
    {
        $produit = Produit::create([
            'user_id' => $request->user()->id,
            'libelle' => $request->libelle,
            'description' => $request->description,
          ]);
          return new ProduitResource($produit);
    }

   public function show(Produit $produit)
    {
        return new ProduitResource($produit);
    }

    public function update(Request $request, Produit $produit)
    {
        if ($request->user()->id !== $produit->user_id) {
            return response()->json(['error' => 'Vous n est pas autorisés à éditer ce produit.'], 403);
        }
        $produit->update($request->only(['libelle', 'description']));
        return new ProduitResource($produit);
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(null, 204);
    }
}
