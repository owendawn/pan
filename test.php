<?php
/**
 * Created by PhpStorm.
 * User: owen pan
 * Date: 2016/12/20
 * Time: 8:38
 */


$filename = ".env";
var_dump(dirname(__FILE__));
$handle = fopen($filename, "r");//读取二进制文件时，需要将第二个参数设置成'rb'

//通过filesize获得文件大小，将整个文件一下子读到一个字符串中
$contents = fread($handle, filesize ($filename));
fclose($handle);
var_dump($contents);

var_dump(file($_SERVER['PATH_TRANSLATED']));
