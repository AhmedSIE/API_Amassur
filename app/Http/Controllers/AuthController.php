<?php

namespace App\Http\Controllers;

use App\User;
use App\Produit;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Nexmo;

class AuthController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api', ['except' => ['register', 'login','loginemail','usertoken']]);
    }

    public function register(Request $request)
    {
      $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'password' => bcrypt($request->password),
        'carte_id' => 1,
      ]);
      $token = auth()->login($user);
      return $this->respondWithToken2($token,$user);
    }
    public function edit(Request $request)
    {
        $user=$request->user();
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->email=$request->email;
        $user->telephone=$request->telephone;
        if ($request->paswsord!=null) {
            if($user->password == bcrypt($request->ancienpassword)){
                $user->password = bcrypt($request->password);
            }else{
                return response()->json('Erreur');
            }
        }
        $user->save();
        return response()->json($user);
    }

    public function photo(Request $request )
    {
        // $request->user();
        if ($request->user()) {
            $id=$request->user()->id;
            $profil=User::where('id',$id)->first();
            $profil->photo=$request->photo;
            $profil->save();
            return response()->json($profil->photo);
        }
        return response()->json(['error' => 'Non autoriser'], 401);
    }
    public function usertoken(Request $request){
        $token=$request->user();
        if ($token!= null) {
            return response()->json($token);
        }else{
            return response()->json('erreur');
        }
    }
    public function login(Request $request)
    {
        $user = User::where('telephone', $request->telephone)->first();

        if ($user==!null) {
            return $this->respondWithToken($user);
        }

        return response()->json(['error' => 'Non autoriser'], 401);
    }

    public function loginemail(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if ($token = auth()->attempt($credentials)) {
            $user = $request->user();
            return $this->respondWithToken2($token, $user);
        }

        return response()->json(['error' => 'Non autoriser'], 401);
    }

    public function user()
    {
        return response()->json($this->guard()->user());
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Vous êtes déconnectés avec succes !']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($user)
    {
        $otp=$this->generateNumericOTP(6);

        try {
            //code...
            Nexmo::message()->send([
                'to'    => $user->telephone ,
                'from' => '22671528080' ,
                'text' => 'Code OTP : '.$otp
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json(['otp' =>$otp,]);
    }

    protected function respondWithToken2($token,$user)
    {
        return response()->json([
            'nom' =>$user->nom,
            'prenom' =>$user->prenom,
            'email' =>$user->email,
            'photo' => $user->photo,
            'telephone' => $user->telephone,
            'carte_id' => $user->carte_id,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
    // Function to generate OTP
    function generateNumericOTP($n) {

        $generator = "1357902468";

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }

        // Return result
        return $result;
    }

    public function guard()
    {
        return Auth::guard();
    }


}
