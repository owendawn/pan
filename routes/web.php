<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//=============================精准路径====================================
Route::group(["prefix" => "init"], function () {
    Route::any('/init', function (\App\Http\Controllers\UserController $userController) {
        return  $userController->superLogin()->with("base_url", Config::get("app.base_url"));
    });
});

Route::group(["prefix" => "user"], function () {
    Route::any('/login', function (\App\Http\Controllers\UserController $userController) {
        return  $userController->login()->with("base_url", Config::get("app.base_url"));
    });
});


//=============================范路径=================================

Route::get('/', function () {
    return view('index')->with("base_url", Config::get("app.base_url"));
});

Route::get('/{f1}', function ($f1) {
    return view($f1)->with("base_url", Config::get("app.base_url"));
});
Route::get('/{d1}/{f1}', function ($d1, $f1) {
    return view($d1 . "/" . $f1)->with("base_url", Config::get("app.base_url"));
});

Route::get('/{d1}/{d2}/{f1}', function ($d1, $d2,$f1) {
    return view($d1 . "/".$d2."/" . $f1)->with("base_url", Config::get("app.base_url"));
});




//Route::get('/auth', [
//    'middleware' => 'auth',
//    'uses' => 'Auth\LoginController@login'
//]);
//
//Route::group(["prefix" => "admin","domain"=>"localhost"], function () {
//    Route::any('index｛id?｝', function ($id=-1) {
//        return view('index')->with("msg", 'admin')->with("id", $id);
//    })->where('id', "[0-9]+");;
//});


