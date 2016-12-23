<?php
/**
 * Created by PhpStorm.
 * User: owen pan
 * Date: 2016/11/30
 * Time: 16:33
 */

namespace App\Http\Controllers;

use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function superLogin()
    {
        $name = $_REQUEST["name"];
        $pwd = $_REQUEST["pwd"];
        if ($name == "Admin" && $pwd == "Admin") {
            return view("init/init")->with("login", true);
        } else {
            return view('init/login')->with("login", false)->with("loginInfo", "超级用户名或密码错误");
        }
    }

    public function login()
    {
        $name = $_REQUEST["name"];
        $pwd = $_REQUEST["password"];
        if ($name == "Admin" && $pwd == "Admin") {
//            $dt = new \DateTime();
//            $request->session()->put('Admin', Uuid::uuid() . "-" . $dt->getTimestamp());
//            var_dump($request->session());
//            echo Session::get("key");
////            var_dump(Session::shouldReceive());
//            Session::put('key','value');
            return view("index")->with("login", true);
        } else {
            return view('login/login')->with("login", false)->with("loginInfo", "User or Password is Wrong!");
        }
    }

}