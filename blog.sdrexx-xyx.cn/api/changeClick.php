<?php
    include_once dirname(__FILE__).'/conn.php';
    $_click =$_POST['click'];
    $_redata=$_POST['redata'];
    $str="";
    $sql = "UPDATE `Message` SET`click`='$_click' WHERE `data`='$_redata'";
    $res = mysqli_query($link,$sql);
    if($res){
        echo '1';
    }else{
        echo '0';
    }
    mysqli_close($link);
?>