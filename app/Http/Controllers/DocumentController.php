<?php

namespace App\Http\Controllers;

use App\Assurancesauto;
use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function fichiers(Request $request){
        $id=$request->user()->id;
        $photos=Assurancesauto::select('photoimmatriculation','modestationnement')->where('photoimmatriculation','!=',null)->get();
        $contrats=Document::where('type','contrat')->where('user_id',$id)->get();
        $attestations=Document::where('type','attestation')->where('user_id',$id)->get();
        $factures=Document::where('type','facture')->where('user_id',$id)->get();
        $devis=Document::where('type','devis')->where('user_id',$id)->get();

        return response()->json([
            'photos'=>$photos,
            'contrats'=>$contrats,
            'attestations'=>$attestations,
            'factures'=>$factures,
            'devis'=>$devis,
        ]);
    }
}
