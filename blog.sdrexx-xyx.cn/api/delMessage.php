<?php
    include_once dirname(__FILE__).'/conn.php';
    $_data =$_POST['data'];
    $sql = "DELETE FROM Message WHERE data='$_data'";
    $res = mysqli_query($link,$sql);
    if( $res){
        echo '删除成功';
    }else{
        echo '删除失败';
    }
    mysqli_close($link);
?>