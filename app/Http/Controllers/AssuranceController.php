<?php

namespace App\Http\Controllers;

use App\Assurance;
use App\Assurancesauto;
use App\Assurancesmoto;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{
    public function autosave(Request $request){
        $assurance= new Assurance();
        $assurance->user_id=$request->user()->id;
        $assurance->carte_id=1;
        $assurance->assureur=$request->compagnie;
        $assurance->type_assurance='Assurance Auto';
        $assurance->modepayement=$request->modepayement;
        $assurance->offre=$request->offre;
        $assurance->ville=$request->ville;
        $assurance->age=$request->age;
        $assurance->save();
        $assuranceAuto = new Assurancesauto();
        $assuranceAuto->assurance_id=$assurance->id;
        $assuranceAuto->modestationnement='test';
        $assuranceAuto->modele=$request->modele;
        $assuranceAuto->marque=$request->marque;
        $assuranceAuto->immatriculation=$request->immatriculation;
        // $assuranceAuto->photoimmatriculation=$request->carteGriseImage;
        // $assuranceAuto->photopermis=$request->permisEnImage;
        $assuranceAuto->agepermis=$request->agepermis;
        $assuranceAuto->corporel=$request->corporel;
        $assuranceAuto->materiel=$request->materiel;
        $assuranceAuto->vol=$request->vol;
        $assuranceAuto->brisGlace=$request->brisGlace;
        $assuranceAuto->save();
        // dd($assurance->all());
        return response()->json('Votre requête est en cours de traitement');
    }
    public function motosave(Request $request){

        $assurance= new Assurance();
        $assurance->user_id=$request->user()->id;
        $assurance->carte_id=1;
        $assurance->assureur=$request->compagnie;
        $assurance->type_assurance='Assurance Moto';
        $assurance->modepayement=$request->modepayement;
        $assurance->offre=$request->offre;
        $assurance->ville=$request->ville;
        $assurance->age=$request->age;
        $assurance->save();
        $assuranceMoto = new Assurancesmoto();
        $assuranceMoto->assurance_id=$assurance->id;
        $assuranceMoto->modestationnement='test';
        $assuranceMoto->modele=$request->modele;
        $assuranceMoto->marque=$request->marque;
        $assuranceMoto->immatriculation=$request->immatriculation;
        // $assuranceMoto->photoimmatriculation=$request->carteGriseImage;
        $assuranceMoto->save();

        return response()->json('Votre requête est en cours de traitement');
    }
}
