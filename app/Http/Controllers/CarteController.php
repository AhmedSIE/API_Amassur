<?php

namespace App\Http\Controllers;

use App\Carte;
use App\Service;
use Illuminate\Http\Request;

class CarteController extends Controller
{
    public function free() {
        // dd('ok');
        $services= Carte::join('cartes_services','cartes_services.carte_id','cartes.id')
        ->join('services','cartes_services.service_id','services.id')
        ->where('cartes.id',1)->get();

        $autres=collect([]);
        foreach ($services as $service) {
            $autres->push($service->id);
        }

        $autreservices=Service::whereNotIn('id',$autres)->get();
        return response()->json([
            'autreservices'=>$autreservices,
            'messervices'=>$services
            ]
        );
    }
    public function silver() {
        $services= Carte::join('cartes_services','cartes_services.carte_id','cartes.id')
        ->join('services','cartes_services.service_id','services.id')
        ->where('cartes.id',2)->get();

        $autres=collect([]);
        foreach ($services as $service) {
            $autres->push($service->id);
        }

        $autreservices=Service::whereNotIn('id',$autres)->get();
        return response()->json([
            'autreservices'=>$autreservices,
            'messervices'=>$services
            ]
        );
    }
    public function gold() {
        $services= Carte::join('cartes_services','cartes_services.carte_id','cartes.id')
        ->join('services','cartes_services.service_id','services.id')
        ->where('cartes.id',3)->get();
        $autres=collect([]);
        foreach ($services as $service) {
            $autres->push($service->id);
        }

        $autreservices=Service::whereNotIn('id',$autres)->get();
        return response()->json([
            'autreservices'=>$autreservices,
            'messervices'=>$services
            ]
        );
    }
    public function platinum() {
        $services= Carte::join('cartes_services','cartes_services.carte_id','cartes.id')
        ->join('services','cartes_services.service_id','services.id')
        ->where('cartes.id',4)->get();
        $autres=collect([]);
        foreach ($services as $service) {
            $autres->push($service->id);
        }

        $autreservices=Service::whereNotIn('id',$autres)->get();
        return response()->json([
            'autreservices'=>$autreservices,
            'messervices'=>$services
            ]
        );
    }
    public function souscrire(Request $request) {
        $user=$request->user();
        $user->carte_id=$request->carte;
        $user->save();
        return response()->json($user);
    }
}
