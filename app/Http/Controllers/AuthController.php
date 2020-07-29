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
         $this->middleware('auth:api', ['except' => ['register', 'login','loginemail']]);
    }

    public function register(Request $request)
    {
      $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'password' => bcrypt($request->password),
      ]);
      $token = auth()->login($user);
      return $this->respondWithToken2($token,$user);
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
