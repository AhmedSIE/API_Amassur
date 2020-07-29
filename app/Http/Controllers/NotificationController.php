<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification(){
        $notification=Notification::all();
        return response()->json($notification);
    }
}
