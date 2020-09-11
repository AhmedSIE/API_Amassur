<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function save(Request $request){
        $user=$request->user()->id;
        $message= new Message();
        $message->user_id=$user;
        $message->statut='envoyé';
        $message->texte=$request->message;
        $message->save();
        $messages=Message::where('user_id',$request->user()->id)->get();
        event(new MyEvent($message));
        return response()->json($messages);
    }
    public function index(Request $request){
        $messages=Message::where('user_id',$request->user()->id)->get();
        return response()->json($messages);
    }
}
