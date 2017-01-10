<?php
/**
 * Created by PhpStorm.
 * User: owen pan
 * Date: 2016/12/26
 * Time: 15:24
 */

namespace App\Http\Controllers;


use DateTime;
use Illuminate\Support\Facades\Session;

class ViewController extends Controller
{
    private static $except=[
        "/",
        "/index",
        "/redirect",
        "/login/login",
        "/login/loginbg",
        "/login/register",
        "/login/registerbg",
    ];

    public function checkLogined()
    {
//        var_dump(Session::all());
        $propath=substr($_SERVER["REQUEST_URI"],strlen(\Config::get("app.base_url")));
        if(strpos($propath,"?")!=false) {
           $propath=substr($propath, 0, strpos($propath, "?"));
        }
        if(in_array($propath,self::$except)){
            $dt = new Datetime();
            $keys = Session::all();
            $key = isset($keys["lkey"]) ? $keys["lkey"] : "";
//        $key=$request->session()->get('lkey');
            if ($key != null) {

                $t = intval(substr($key, strrpos($key,"-")+1, 10));
//                var_dump((($dt->getTimestamp() - $t) / 60) . "min");
                if ($dt->getTimestamp() - $t > 30 * 60) {
//                    var_dump("over");
                    $dt->setTimestamp($t);
                    Session::forget("lkey");
                    array('pass'=>"notlogin");
                }
                $dt->setTimestamp($t);
            } else {
                array('pass'=>"notlogin");
            }
//            var_dump("ok");
            return array('pass'=>"login");
        }else {
            $dt = new Datetime();
            $keys = Session::all();
            $key = isset($keys["lkey"]) ? $keys["lkey"] : "";
//        $key=$request->session()->get('lkey');
            if ($key != null) {

                $t = intval(substr($key, strrpos($key,"-")+1, 10));
//                var_dump((($dt->getTimestamp() - $t) / 60) . "min");
                if ($dt->getTimestamp() - $t > 30 * 60) {
//                    var_dump("over");
                    $dt->setTimestamp($t);
                    Session::forget("lkey");
                    return false;
                }
                $dt->setTimestamp($t);
            } else {
                return false;
            }
//            var_dump("ok");
            return true;
        }
    }


    public function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }
}