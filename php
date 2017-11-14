<?php
/**
 * Created by PhpStorm.
 * User: inori
 * Date: 2017/10/25
 * Time: 15:41
 */
//echo 123;
error_reporting(0);
define(DB_HOST,"127.0.0.1");
define(DB_USERNAME,"root");
define(DB_PASSWROD,"");
define(DB_DATABASENAME,"bbs");
define(DB_PORT,"3306");

$dbCoon =new mysqli(DB_HOST,DB_USERNAME,DB_PASSWROD,DB_DATABASENAME,DB_PORT)or die("DB conn error:".mysqli_error());

$username = $_POST["username"];
$password = $_POST["password"];
$sql = "select count(*) as unum from yonghu where username='".$username."'";
//echo $sql;
$results = $dbCoon->query($sql);

//var_dump($results);
if($results){
    $row = $results->fetch_array();
    if($row[unum]==0){
        setcookie("username",$username);
        $sql = "insert into yonghu(username,PASSWORD) value('".$username."','".$password."')";
        echo "成功";
        echo $sql;
        $dbCoon->query($sql);
        echo "<script language='javascript'>location.href='success.html'</script>";
    }else{
        setcookie("message","对不起注册失败，用户名或密码错误");
        echo "<script language='javascript'>location.href='failure.html'</script>";
    }
}
//?>
