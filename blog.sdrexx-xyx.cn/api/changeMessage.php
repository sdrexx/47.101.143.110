<?php
    include_once dirname(__FILE__).'/conn.php';
    $_title =$_POST['title'];
    $_data =$_POST['data'];
    $_previewmes=$_POST['previewmes'];
    $_previewimg =$_POST['previewimg'];
    $_message=$_POST['message'];
    $_redata=$_POST['redata'];
    $str="";
    $sql = "UPDATE `Message` SET`title`='$_title',`data`='$_data',`previewmes`='$_previewmes',`previewimg`='$_previewimg',`message`='$_message' WHERE `data`='$_redata'";
    $res = mysqli_query($link,$sql);
    if($res){
        echo '1';
    }else{
        echo '0';
    }
    mysqli_close($link);
?>