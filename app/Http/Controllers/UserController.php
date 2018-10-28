<?php
/**
 * Created by PhpStorm.
 * User: owen pan
 * Date: 2016/11/30
 * Time: 16:33
 */

namespace App\Http\Controllers;

use App\Http\Extra\SqlExtra;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function superLogin()
    {
        $name = $_REQUEST["name"];
        $pwd = $_REQUEST["pwd"];
        if ($name == "Admin" && $pwd == "Admin") {
            return view("init/init")->with("logined", true);
        } else {
            return view('init/login')->with("logined", false)->with("loginInfo", "超级用户名或密码错误");
        }
    }

    public function login(\Symfony\Component\HttpFoundation\Request $request)
    {
        $name = $_REQUEST["name"];
        $pwd = $_REQUEST["password"];
        $store = isset($_REQUEST["store"])?$_REQUEST["store"]:"";
        try {
            $sqlExtra = new SqlExtra();
            $pdo = $sqlExtra->getPDO();
            $ps=$pdo->prepare("select PASSWORD as pwd,id as id from user where NAME= :name");
            $ps->execute(array(':name' => $name));
            if($ps->rowCount()>0){
                $all=$ps->fetchAll();
                $pwdreal=$all[0]["pwd"];
                $id=$all[0]["id"];
                if($pwd==$pwdreal){
                    $dt = new \DateTime();
                    $key=$id."-".$name.'-'.Uuid::uuid() . "-" .$dt->getTimestamp();
                    $request->session()->put('lkey', $key);
                    $encreptKey=base64_encode(base64_encode($key.($store=="on"?"-all":"")));
                    return redirect("index")->with("login", true)->with("path","/index")->with("isStore",$store=="on"?true:false)->with("storeKey",$encreptKey)->with("session",$key);
                }else{
                   $info="User or Password is Wrong!";
                }
            }else{
                $info="the name is not exists!";
            }
        }catch (\PDOException $e){
            $info="cause exception ( ".$e->getMessage()." ) !";
        }
        return view('login/login')->with("login", false)->with("loginInfo", $info)->with("name",$name);
//        if ($name == "Admin" && $pwd == "Admin") {
////            $dt = new \DateTime();
////            $request->session()->put('Admin', Uuid::uuid() . "-" . $dt->getTimestamp());
////            var_dump($request->session());
////            echo Session::get("key");
//////            var_dump(Session::shouldReceive());
////            Session::put('key','value');
//            return view("index")->with("login", true);
//        } else {
//            return view('login/login')->with("login", false)->with("loginInfo", "User or Password is Wrong!");
//        }
    }

    public function logout(){
        Session::forget("lkey");
//        return  redirect()->route("logoutDirectView");
        return redirect("login/login")->with("clearStoreKey",true);
    }

    public function register(){
        $name = $_REQUEST["name"];
        $pwd = $_REQUEST["password"];
        $pwd2 = $_REQUEST["passwordcheck"];
        $mail = $_REQUEST["mail"];
        $info="";
        $view="login/register";
        $success=false;
        if($pwd==$pwd2){
            try {
                $sqlExtra = new SqlExtra();
                $pdo = $sqlExtra->getPDO();
                $ps=$pdo->prepare("select count(1) as count from user where NAME= :name");
                $ps->execute(array(':name' => $name));
                if($ps->rowCount()>0&&$ps->fetchAll()[0]["count"]>0){
                    $info="the name is already exists!";
                }else{
                    $ps=$pdo->prepare("insert into user (NAME,email,PASSWORD) values (:name,:mail,:pwd)");
                    $ps->execute(array(':name' => $name,":mail"=>$mail,":pwd"=>$pwd));
                    if($ps->rowCount()>0){
                        $view="login/login";
                        $success=true;
                        return redirect($view)->with("register", $success)->with("info", $info)->with("msg",array("name"=>$name,"mail"=>$mail));
                    }else{
                        $info="create new account fail ,please try again!";
                    }
                }
            }catch (\PDOException $e){
                $info="cause exception ( ".$e->getMessage()." ) !";
            }
        }else{
            $info="password again is't same as password!";
        }
        return view($view)->with("register", $success)->with("info", $info)->with("msg",array("name"=>$name,"mail"=>$mail));
    }

    public function  checkloginAlways(){
        $encreptkey=$_REQUEST["key"];
        if(isset($encreptkey)&&strlen($encreptkey)>0) {
            $decreptkey = base64_decode(base64_decode($encreptkey));
            if(substr($decreptkey,strlen($decreptkey)-3)=="all"){
                $time=intval(substr($decreptkey,strlen($decreptkey)-14,10));
                $now=new \DateTime();
                if($now->getTimeStamp()-$time<60*60*24**30){
                    return "true";
                }
            }
        }else{
            return "false";
        }
    }

}