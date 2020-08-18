<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/message', function () {
    $message['user'] = "Juan Perez";
    $message['message'] =  "Prueba mensaje desde Pusher";
    $success = event(new App\Events\NewMessage($message));
    return $success;
});

Route::get('react-message', function() {
    return view('message');
});
