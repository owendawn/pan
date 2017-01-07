<?php
/**
 * Created by PhpStorm.
 * User: owen pan
 * Date: 2017/1/4
 * Time: 16:46
 */

namespace App\Http\Controllers;

use App\Http\Extra\SqlExtra;
use App\Utils\DataHandlerUtil;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideoOfAvailable(Request $request){
        $sEcho=intval($_REQUEST["sEcho"]);
        $sortColIndex=$_REQUEST["iSortCol_0"];
        $sortType=$_REQUEST["sSortDir_0"];
        $sortCol=$_REQUEST["mDataProp_".$sortColIndex];
        $start=$_REQUEST["iDisplayStart"];
        $length=$_REQUEST["iDisplayLength"];
        if(isset($_REQUEST["userid"])) {
            $uid = $_REQUEST["userid"];
            $key = null;
            if (strpos($uid, "-") == false) {
                $key = base64_decode(base64_decode($uid));
            } else {
                $key = $uid;
            }
            $userId=intval(substr($key,0,strpos($key,"-")));
            $sqlExtra = new SqlExtra();
            $infos = [];
            try {
                $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
                $ps=$pdo->prepare("select count(1) as cnt from videos where status=0 and userid=:userid");
                $ps->execute(array(":userid"=>$userId));
                if ($ps->rowCount() > 0) {
                    $data = [];
                    $cnt = $ps->fetchAll()[0]["cnt"];
                    if ($cnt > 0) {
                        $ps = $pdo->prepare("select * from videos where status=0 and userid=:userid order by ".$sortCol." ".$sortType." LIMIT :start,:length ");
                        $ps->execute(array(":start" => intval($start), ":length" => intval($length),":userid"=>$userId));
                        $data = $ps->fetchAll();
                    }
                    return DataHandlerUtil::returnJsonOnly(array("aaData" => $data, "sEcho" => $sEcho, "iTotalRecords" => sizeof($data), "iTotalDisplayRecords" => $cnt));
                }
            } catch (\PDOException $e) {
                return DataHandlerUtil::returnJsonOnly(array("aaData" => [], "sEcho" => $sEcho, "iTotalRecords" => 0, "iTotalDisplayRecords" => 0,"isSuccess" => false, 'infos' => DataHandlerUtil::getUtf8FromGbk($e->getMessage())));
            }
        }else{
            return DataHandlerUtil::returnJsonOnly(array("aaData" => [], "sEcho" => $sEcho, "iTotalRecords" => 0, "iTotalDisplayRecords" => 0,"info"=>"userId is missing"));
        }
    }

    public function getVideoOfTrash(Request $request){
        $sEcho=intval($_REQUEST["sEcho"]);
        $sortColIndex=$_REQUEST["iSortCol_0"];
        $sortType=$_REQUEST["sSortDir_0"];
        $sortCol=$_REQUEST["mDataProp_".$sortColIndex];
        $start=$_REQUEST["iDisplayStart"];
        $length=$_REQUEST["iDisplayLength"];
        if(isset($_REQUEST["userid"])) {
            $uid = $_REQUEST["userid"];
            $key = null;
            if (strpos($uid, "-") == false) {
                $key = base64_decode(base64_decode($uid));
            } else {
                $key = $uid;
            }
            $userId=intval(substr($key,0,strpos($key,"-")));
            $sqlExtra = new SqlExtra();
            $infos = [];
            try {
                $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
                $ps=$pdo->prepare("select count(1) as cnt from videos where status=1 and userid=:userid");
                $ps->execute(array(":userid"=>$userId));
                if ($ps->rowCount() > 0) {
                    $data = [];
                    $cnt = $ps->fetchAll()[0]["cnt"];
                    if ($cnt > 0) {
                        $ps = $pdo->prepare("select * from videos where status=1 and userid=:userid order by ".$sortCol." ".$sortType." LIMIT :start,:length ");
                        $ps->execute(array(":start" => intval($start), ":length" => intval($length),":userid"=>$userId));
                        $data = $ps->fetchAll();
                    }
                    return DataHandlerUtil::returnJsonOnly(array("aaData" => $data, "sEcho" => $sEcho, "iTotalRecords" => sizeof($data), "iTotalDisplayRecords" => $cnt));
                }
            } catch (\PDOException $e) {
                return DataHandlerUtil::returnJsonOnly(array("aaData" => [], "sEcho" => $sEcho, "iTotalRecords" => 0, "iTotalDisplayRecords" => 0,"isSuccess" => false, 'infos' => DataHandlerUtil::getUtf8FromGbk($e->getMessage())));
            }
        }else{
            return DataHandlerUtil::returnJsonOnly(array("aaData" => [], "sEcho" => $sEcho, "iTotalRecords" => 0, "iTotalDisplayRecords" => 0,"info"=>"userId is missing"));
        }
    }

    public function addNewVideo(Request $request){
        $title=$this->getRequestParam("title");
        $link=$this->getRequestParam("link");
        $image=$this->getRequestParam("image");
        $time=$this->getRequestParam("time");
        $userId=$this->getRequestParam("userId");
        $sqlExtra = new SqlExtra();
        try {
            $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
            $ps=$pdo->prepare("insert into videos (userid,link,img,title,week,status) values (:userId,:link,:img,:title,:week,0)");
            $ps->execute(array(":userId"=>$userId,":link"=>$link,":img"=>$image,":title"=>$title,":week"=>$time));
            if($ps->errorCode()=="00000"){
                return DataHandlerUtil::returnJson("00000",array());
            }else{
                return DataHandlerUtil::returnJson($ps->errorCode(),array("info"=>$ps->errorInfo()));
            }
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(),array("info"=>$e->getMessage()));
        }
    }

    public function editVideoById(Request $request){
        $id=$this->getRequestParam("id");
        $title=$this->getRequestParam("title");
        $link=$this->getRequestParam("link");
        $image=$this->getRequestParam("image");
        $time=$this->getRequestParam("time");
        $userId=$this->getRequestParam("userId");
        if (strpos($userId, "-") == false) {
            $userId = base64_decode(base64_decode($userId));
        }
        $userId=intval(substr($userId,0,strpos($userId,"-")));
        $sqlExtra = new SqlExtra();
        try {
            $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
            $ps=$pdo->prepare("update videos set link=:link,img=:img,title=:title,week=:week,updated_at=SYSDATE() where userid=:userId and id=:id");
            $ps->execute(array(":userId"=>$userId,":link"=>$link,":img"=>$image,":title"=>$title,":week"=>$time,":id"=>$id));
            if($ps->errorCode()=="00000"){
                return DataHandlerUtil::returnJson("00000",array());
            }else{
                return DataHandlerUtil::returnJson($ps->errorCode(),array("info"=>$ps->errorInfo()));
            }
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(),array("info"=>$e->getMessage()));
        }
    }

    public function fackDeleteById(Request $request){
        $id=$this->getRequestParam("id");
        $userId=$this->getRequestParam("userId");
        if (strpos($userId, "-") == false) {
            $userId = base64_decode(base64_decode($userId));
        }
        $userId=intval(substr($userId,0,strpos($userId,"-")));
        $sqlExtra = new SqlExtra();
        try {
            $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
            $ps=$pdo->prepare("update  videos set status =1 ,updated_at=SYSDATE() where userid=:userId and id=:id");
            $ps->execute(array(":id"=>$id,":userId"=>$userId));
            if($ps->errorCode()=="00000"){
                return DataHandlerUtil::returnJson("00000",array());
            }else{
                return DataHandlerUtil::returnJson($ps->errorCode(),array("info"=>$ps->errorInfo()));
            }
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(),array("info"=>$e->getMessage()));
        }
    }

    public function deleteById(Request $request){
        $id=$this->getRequestParam("id");
        $userId=$this->getRequestParam("userId");
        if (strpos($userId, "-") == false) {
            $userId = base64_decode(base64_decode($userId));
        }
        $userId=intval(substr($userId,0,strpos($userId,"-")));
        $sqlExtra = new SqlExtra();
        try {
            $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
            $ps=$pdo->prepare("update  videos set status =2 ,updated_at=SYSDATE() where userid=:userId and id=:id");
            $ps->execute(array(":id"=>$id,":userId"=>$userId));
            if($ps->errorCode()=="00000"){
                return DataHandlerUtil::returnJson("00000",array());
            }else{
                return DataHandlerUtil::returnJson($ps->errorCode(),array("info"=>$ps->errorInfo()));
            }
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(),array("info"=>$e->getMessage()));
        }
    }

    public function reductedById(Request $request){
        $id=$this->getRequestParam("id");
        $userId=$this->getRequestParam("userId");
        if (strpos($userId, "-") == false) {
            $userId = base64_decode(base64_decode($userId));
        }
        $userId=intval(substr($userId,0,strpos($userId,"-")));
        $sqlExtra = new SqlExtra();
        try {
            $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
            $ps=$pdo->prepare("update  videos set status =0 ,updated_at=SYSDATE() where userid=:userId and id=:id");
            $ps->execute(array(":id"=>$id,":userId"=>$userId));
            if($ps->errorCode()=="00000"){
                return DataHandlerUtil::returnJson("00000",array());
            }else{
                return DataHandlerUtil::returnJson($ps->errorCode(),array("info"=>$ps->errorInfo()));
            }
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(),array("info"=>$e->getMessage()));
        }
    }

    public function getImgUrlByName(Request $request){
        include_once(dirname(dirname(__DIR__))."/Utils/simple_html_dom.php");
        $html=new \simple_html_dom();
        $words=$this->getRequestParam("words");
        if($words==""){
            return DataHandlerUtil::returnJson("-1",array("info"=>"please fill the video's name"));
        }else{
            $html->load_file('http://v.baidu.com/v?ct=301989888&rn=20&pn=0&db=0&s=25&ie=utf-8&word='.urlencode("°Ö°ÖÈ¥ÄÄ¶ù"));
            $imgs=$html->find("#content>.main-content>.special-wrap>.sp-cont-show>.detail-info>.poster>.poster-link>img");
            $imgsall=$imgs;
//            $html->load_file('http://m.v.baidu.com/search?src=video&word='.urlencode("°Ö°ÖÈ¥ÄÄ¶ù"));
//            $imgs2=$html->find("#search-page>.search-bd>.search-block.search-block-tvshow>.special-base-wrap>.base-poster>img");
//            $imgsall=array_merge($imgs,$imgs2);
            $srcs=[];
            foreach($imgsall as $img){
                $src=$img->src;
                if(strpos($src,".hiphotos.baidu")==false&&strpos($src,".baidu.com/it/u")!=false) {
                    array_push($srcs,$src);
//                    echo "<img src='" . $img->src . "' style='width:100px:height:50px;'/>";
//                    echo $img->src;
//                    echo "<br>";
                }
            }
            return DataHandlerUtil::returnJson("00000",array("data"=>$srcs));
        }
    }
}