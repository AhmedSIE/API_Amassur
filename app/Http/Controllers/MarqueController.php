<?php

namespace App\Http\Controllers;

use App\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index(){
        $marques=Marque::all();
        return response()->json($marques);
    }
}
