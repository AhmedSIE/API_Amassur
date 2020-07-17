<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserProduitsOrigines;

class UserController extends Controller
{
    public function index()
    {
        return UserProduitsOrigines::collection(User::all());
    }
   
    public function show(Request $request)
    {
        return new UserProduitsOrigines($request->user());
    }
}
