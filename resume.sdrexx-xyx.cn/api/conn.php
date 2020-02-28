<?php
    header("Content-type:application/x-www-form-urlencoded");
    header("Access-Control-Allow-Origin:*");
    $host='localhost';
    $user='root';
    $password='xuyuxing1574587';
    $dbName='resume';
    $link = mysqli_connect($host,$user,$password,$dbName);
    if (!$link) {
        exit('连接数据库失败');
        }
        mysqli_set_charset($link,'utf8');
?>