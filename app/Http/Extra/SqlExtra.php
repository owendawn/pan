<?php
namespace App\Http\Extra;

/**
 * Created by PhpStorm.
 * User: owen pan
 * Date: 2016/12/23
 */
class SqlExtra
{
    protected static $_dbh;
    protected $_dsn;
    protected $_driver;
    protected $_host;
    protected $_database;
    protected $_username;
    protected $_password;
    protected $_port;

    protected $_pconnect = true; //是否使用长连接

    public function __construct(){
        class_exists('PDO') or die("PDO: class not exists.");
        //连接数据库
        if ( is_null(self::$_dbh) ) {
            $__dbconf=\Config::get("database")["connections"]["mysql"];
            $this->_driver=$__dbconf["driver"];
            $this->_host=$__dbconf["host"];
            $this->_database=$__dbconf["database"];
            $this->_username=$__dbconf["username"];
            $this->_password=$__dbconf["password"];
            $this->_port=$__dbconf["port"];
            $this->_dsn= $this->_driver.':host='.$this->_host.';dbname='.$this->_database;
            return $this->_connect();
        }
    }

    /**
     * 连接数据库的方法
     */
    protected function _connect() {
        $options=array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, //设置如果sql语句执行错误则抛出异常，事务会自动回滚
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            \PDO::ATTR_EMULATE_PREPARES=> false//禁用prepared statements的仿真效果(防SQL注入)
        );
        if( $this->_pconnect){
            array_add($options,\PDO::ATTR_PERSISTENT,true);
        }
        try {
            $dbh = new \PDO($this->_dsn, $this->_username, $this->_password, $options);
        } catch (\PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
        self::$_dbh = $dbh;
       return $this;
    }

    public function getPDO(){
        return self::$_dbh;
    }


}