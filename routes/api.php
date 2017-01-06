<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::post('/user!{method}', function (\App\Http\Controllers\UserController $userController, $method, Request $request) {
//        Cache::put('cache1','cache1-value',1);
//        Cache::put('cache2','cache2-value',1);
//        Session::put('session1','session1-value',1);
//        Session::put('session2','session2-value',1);
        return $userController->$method($request);
    });
    Route::any("/init!{method}",function(\App\Http\Controllers\InitController $initController,$method,Request $request){
       return $initController->$method($request);
    });

});


Route::post('/vedios!{method}', function (\App\Http\Controllers\VideoController $videoController, $method, Request $request) {
    return $videoController->$method($request);
});

//Route::get('/auth', [
//    'middleware' => 'auth',
//    'uses' => 'Auth\LoginController@login'
//]);


//Route::group(["namespace" => "admin"], function () {
//    Route::group(['namespace' => "user"], function (Request $request) {
//        return $request->user();
//    });
//});