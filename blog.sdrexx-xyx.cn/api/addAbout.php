<?php 
    include_once dirname(__FILE__).'/conn.php';
    $_message =$_POST['message'];
    $sql = "INSERT INTO `About`( `message`) VALUES ('$_message')";
    $res = mysqli_query($link,$sql);
    if( $res){
        echo '提交成功';
    }else{
        echo '提交失败';
    }
    mysqli_close($link);
