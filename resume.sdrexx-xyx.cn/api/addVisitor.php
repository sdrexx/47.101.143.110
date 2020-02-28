<?php 
    include_once dirname(__FILE__).'/conn.php';
    $_name =$_POST['name'];
    $_email =$_POST['email'];
    $_tel =$_POST['tel'];
    $_message=$_POST['message'];
    $sql = "INSERT INTO `visitor`( `name`, `email`, `tel`,`message`) VALUES ('$_name','$_email','$_tel','$_message')";
    $res = mysqli_query($link,$sql);
    if( $res){
        echo '提交成功';
    }else{
        echo '提交失败';
    }
    mysqli_close($link);
