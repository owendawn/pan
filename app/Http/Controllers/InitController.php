<?php
/**
 * Created by PhpStorm.
 * User: owen pan
 * Date: 2016/12/13
 * Time: 10:05
 */

namespace App\Http\Controllers;


use App\Http\Extra\SqlExtra;
use App\Utils\DataHandlerUtil;

class InitController extends Controller
{

    public function getConnectCheck($request)
    {
        $dsn = 'mysql:host=' . $_REQUEST["ip"];
        $user = $_REQUEST["user"];
        $password = $_REQUEST["pwd"];
        try {
            $dbh = new \PDO($dsn, $user, $password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $re = $dbh->query("select * from ( select SUBSTR(user() FROM 1 FOR INSTR(user(),'@')-1) as user,user() ) b where user= '" . trim($user) . "'");
            if ($re->rowCount() > 0) {
                return DataHandlerUtil::returnJson($dbh->errorCode(), ["isSuccess" => true]);
            }
            return DataHandlerUtil::returnJson($dbh->errorCode(), ["isSuccess" => false]);
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(), ["isSuccess" => false, 'info' => DataHandlerUtil::getUtf8FromGbk($e->getMessage())]);
        }
    }

    public function  getDBNameCheck()
    {
        $ip = $_REQUEST["ip"];
        $db = $_REQUEST["db"];
        $dsn = 'mysql:host=' . $ip . ';dbname=' . $db;
        $user = $_REQUEST["user"];
        $password = $_REQUEST["pwd"];

        try {
            $dbh = new \PDO($dsn, $user, $password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->modifyEnv(["DB_HOST" => $ip, "DB_DATABASE" => $db, "DB_USERNAME" => $user, "DB_PASSWORD" => $password]);
            return DataHandlerUtil::returnJson($dbh->errorCode(), ["isSuccess" => true]);
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(), ["isSuccess" => false, 'info' => DataHandlerUtil::getUtf8FromGbk($e->getMessage())]);
        }
    }

    private function modifyEnv(array $data)
    {
        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
        $contentArray->transform(function ($item) use ($data) {
            foreach ($data as $key => $value) {
                if (str_contains($item, $key)) {
                    return $key . '=' . $value;
                }
            }
            return $item;
        });
        $content = implode($contentArray->toArray(), "\n");
        \File::put($envPath, $content);
    }

    public function getBaseTableInit()
    {
        $infos = [];
        $success = true;
        $sqlExtra = new SqlExtra();
        try {
            $sql = "CREATE TABLE if not exists user  ( id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY key ,name varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,email varchar(255) COLLATE utf8_unicode_ci NOT NULL,password varchar(255) ,created_at timestamp not null , updated_at timestamp ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
            $re = $sqlExtra->getPDO()->exec($sql);
            $success = true && $success;
            array_push($infos, array("code"=>$re,"desc"=>"create table of user :".$re));
            return DataHandlerUtil::returnJson(null, ["isSuccess" => $success, "infos" => $infos]);
        } catch (\PDOException $e) {
            return DataHandlerUtil::returnJson($e->getCode(), ["isSuccess" => false, 'infos' => DataHandlerUtil::getUtf8FromGbk($e->getMessage())]);
        }
    }

}