<?php

namespace App\Http\Controllers;

use App\Assurance;
use App\Assurancesauto;
use App\Assurancesmaison;
use App\Assurancesmoto;
use App\Assurancessante;
use App\Enfant;
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
    public function maisonsave(Request $request){
        $assurance= new Assurance();
        // dd($request->user());
        $assurance->user_id=$request->user()->id;
        $assurance->carte_id=1;
        $assurance->assureur=$request->compagnie;
        $assurance->type_assurance='Assurance Maison';
        $assurance->modepayement=$request->modepayement;
        $assurance->offre=$request->offre;
        $assurance->ville=$request->ville;
        $assurance->save();

        $assuranceMaison = new Assurancesmaison();
        $assuranceMaison->assurance_id=$assurance->id;
        $assuranceMaison->statut=$request->statut;
        $assuranceMaison->bienconcerne=$request->bienconcerne;
        $assuranceMaison->nombrepiece=$request->nombrepiece;
        $assuranceMaison->stockagemarchandise=$request->stockagemarchandise;
        $assuranceMaison->bienprecieux=$request->bienprecieux;
        $assuranceMaison->valeurmobilier=$request->valeurmobilier;
        $assuranceMaison->valeurelectronique=$request->valeurelectronique;
        $assuranceMaison->nombrenfant=$request->nombrenfant;
        $assuranceMaison->nombrehabitant=$request->nombrehabitant;
        $assuranceMaison->save();

        return response()->json('Votre requête est en cours de traitement');
    }
    public function santesave(Request $request){
        // dd($request->all());
        $assurance= new Assurance();
        $assurance->user_id=$request->user()->id;
        $assurance->carte_id=1;
        $assurance->assureur=$request->compagnie;
        $assurance->type_assurance='Assurance Santé';
        $assurance->modepayement=$request->modepayement;
        $assurance->offre=$request->offre;
        $assurance->ville=$request->ville;
        $assurance->save();

        $assuranceSante = new Assurancessante();
        $assuranceSante->assurance_id=$assurance->id;
        $assuranceSante->nom=$request->nom;
        $assuranceSante->prenoms=$request->prenom;
        $assuranceSante->date_naissance=$request->age;
        $assuranceSante->profil=$request->profil;
        $assuranceSante->regime_obligatoire=$request->regimeobligatoire;
        $assuranceSante->email=$request->email;
        $assuranceSante->telephone=$request->telephone;
        $assuranceSante->nomconjoint=$request->nomconjoint;
        $assuranceSante->prenomsconjoint=$request->prenomconjoint;
        $assuranceSante->conjoint_date_naissance=$request->ageconjoint;
        $assuranceSante->conjoint_regime_obligatoire=$request->regimeobligatoirefemme;
        $assuranceSante->nombre_enfants	= count($request->enfants);
        $assuranceSante->save();

        if ($request->enfants!=null) {
            foreach ($request->enfants as $enf) {
                $enfant = new Enfant();
                $enfant->assurancesante_id=$assuranceSante->id;
                $enfant->nomenfant=$enf['nom'];
                $enfant->prenomenfant=$enf['prenom'];
                $enfant->date_naissance=$enf['age'];
                $enfant->regime=$enf['regime'];
                $enfant->save();
            }
        }

        return response()->json('Votre requête est en cours de traitement');
        // return response()->json($assurance->id);
    }

}
