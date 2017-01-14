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

function logindispatch(\App\Http\Controllers\ViewController $viewController, $theview){
//    var_dump(session()->all());
    $re=$viewController->checkLogined();
    if($re==true){
        return $theview->with("base_url", Config::get("app.base_url"))->with("isMobile",$viewController->isMobile())->with("login",true);
    }else if($re==false){
//        return view('login/login')->with("base_url", Config::get("app.base_url"));
        return $theview->with("base_url", Config::get("app.base_url"))->with("isMobile",$viewController->isMobile())->with("checkLogin",true)->with("login",false);
    }else if(is_array($re)){
        if($re["pass"]=="login"){
            return $theview->with("base_url", Config::get("app.base_url"))->with("isMobile",$viewController->isMobile())->with("login",true);
        }else if($re["pass"]=="notlogin"){
            return $theview->with("base_url", Config::get("app.base_url"))->with("isMobile",$viewController->isMobile())->with("login",false);
        }
    }
}

//=============================精准路径====================================
Route::group(["prefix" => "init"], function () {
    Route::any('/init', function (\App\Http\Controllers\UserController $userController) {
        return  $userController->superLogin()->with("base_url", Config::get("app.base_url"));
    });
});

Route::group(["prefix" => "user"], function () {
    Route::any('/login', function (\App\Http\Controllers\UserController $userController,\Symfony\Component\HttpFoundation\Request $request) {
        return  $userController->login($request)->with("base_url", Config::get("app.base_url"));
    });
    Route::any('/register', function (\App\Http\Controllers\UserController $userController) {
        return  $userController->register()->with("base_url", Config::get("app.base_url"));
    });
    Route::any('/logout', function (\App\Http\Controllers\UserController $userController) {
        return  $userController->logout()->with("base_url", Config::get("app.base_url"));
    });
});


//=============================范路径=================================

Route::get('/', function (\App\Http\Controllers\ViewController $viewController) {
    return logindispatch($viewController,view('index'));
});
Route::get('/{f1}', function ($f1,\App\Http\Controllers\ViewController $viewController) {
    return logindispatch($viewController,view($f1));
});
Route::get('/{d1}/{f1}', function ($d1, $f1,\App\Http\Controllers\ViewController $viewController,\Illuminate\Http\Request $req) {
    $xduri=substr($req->getRequestUri(),strlen(Config::get("app.base_url")));
    $xduriOnly=$xduri;
    $index=strpos($xduri,"?");
    if($index!=false){
        $xduriOnly=substr($xduri,0,$index);
    }
    if($xduriOnly=="/enjoy/enjoy"){
        if($viewController->isMobile()){
            $f1="enjoy-mobile";
        }else{
            $f1="enjoy-pc";
        }
    }else if($xduriOnly=="/enjoy/enjoyedit"){
        if($viewController->isMobile()){
            $f1="enjoyedit-mobile";
        }else{
            $f1="enjoyedit-pc";
        }
    }
    return logindispatch($viewController,view($d1 . "/" . $f1));
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


