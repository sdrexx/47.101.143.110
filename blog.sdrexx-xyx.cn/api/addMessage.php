<?php 
    include_once dirname(__FILE__).'/conn.php';
    $_data =$_POST['data'];
    $_previewimg=$_POST['previewimg'];
    $_previewmes=$_POST['previewmes'];
    $_title =$_POST['title'];
    $_message =$_POST['message'];
    $sql = "INSERT INTO `Message`( `title`, `data`,`previewmes`,`previewimg`, `message`,`click`) VALUES ('$_title','$_data','$_previewmes','$_previewimg','$_message',0)";
    $res = mysqli_query($link,$sql);
    if( $res){
        echo '提交成功';
    }else{
        echo '提交失败';
    }
    mysqli_close($link);
