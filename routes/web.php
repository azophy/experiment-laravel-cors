<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend');
});

Route::get('/get_cookies', function(Request $req) {
    return response()->json([
        'cookies' => $req->cookie(),
        'session' => $req->session()->all(),
        'session_id' => $req->session()->getId(),
    ]);
});

Route::get('/set_cookies', function(Request $req) {
    return response()
        ->json(['cookie' => 'ok'])
        ->cookie( // function cookie($name = null, $value = null, $minutes = 0, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
            'experiment_cookie', strval(time()), 120, null, null, true, true, false, 'None'
        );
});

Route::get('/set_cookies_and_redirect', function(Request $req) {
    return redirect()
        ->away($req->redirect_url)
        ->cookie( // function cookie($name = null, $value = null, $minutes = 0, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
            'experiment_cookie', strval(time()), 120, null, null, true, true, false, 'None'
        );
});