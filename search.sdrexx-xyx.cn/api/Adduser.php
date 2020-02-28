<?php 
    include_once dirname(__FILE__).'/conn.php';
    $_title =$_POST['title'];
    $_url =$_POST['url'];
    $sql = "INSERT INTO `lists`( `title`, `url`) VALUES ('$_title','$_url')";
    $res = mysqli_query($link,$sql);
    if( $res){
        echo '注册成功';
    }else{
        echo '注册失败';
    }
    mysqli_close($link);
?>