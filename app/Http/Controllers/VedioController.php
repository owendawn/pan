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

class VedioController extends Controller
{
    public function getVedioOfAvailable(Request $request){
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
                $ps=$pdo->prepare("select count(1) as cnt from vedios where status=0 and userid=:userid");
                $ps->execute(array(":userid"=>$userId));
                if ($ps->rowCount() > 0) {
                    $data = [];
                    $cnt = $ps->fetchAll()[0]["cnt"];
                    if ($cnt > 0) {
                        $ps = $pdo->prepare("select * from vedios where status=0 and userid=:userid order by ".$sortCol." ".$sortType." LIMIT :start,:length ");
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

    public function getVedioOfTrash(Request $request){
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
                $ps=$pdo->prepare("select count(1) as cnt from vedios where status=1 and userid=:userid");
                $ps->execute(array(":userid"=>$userId));
                if ($ps->rowCount() > 0) {
                    $data = [];
                    $cnt = $ps->fetchAll()[0]["cnt"];
                    if ($cnt > 0) {
                        $ps = $pdo->prepare("select * from vedios where status=1 and userid=:userid order by ".$sortCol." ".$sortType." LIMIT :start,:length ");
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

    public function addNewVedio(Request $request){
        $title=$this->getRequestParam("title");
        $link=$this->getRequestParam("link");
        $image=$this->getRequestParam("image");
        $time=$this->getRequestParam("time");
        $userId=$this->getRequestParam("userId");
        $sqlExtra = new SqlExtra();
        try {
            $pdo = $sqlExtra->getPDO();
//            $pdo=new \PDO("","","");
            $ps=$pdo->prepare("insert into vedios (userid,link,img,title,week,status) values (:userId,:link,:img,:title,:week,0)");
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

    public function editVedioById(Request $request){
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
            $ps=$pdo->prepare("update vedios set link=:link,img=:img,title=:title,week=:week,updated_at=SYSDATE() where userid=:userId and id=:id");
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

    public function fackdeleteById(Request $request){
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
            $ps=$pdo->prepare("update  vedios set status =1 ,updated_at=SYSDATE() where userid=:userId and id=:id");
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
            $ps=$pdo->prepare("update  vedios set status =2 ,updated_at=SYSDATE() where userid=:userId and id=:id");
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

    public function reducteById(Request $request){
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
            $ps=$pdo->prepare("update  vedios set status =0 ,updated_at=SYSDATE() where userid=:userId and id=:id");
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
}