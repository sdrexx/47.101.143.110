<?php 
    include_once dirname(__FILE__).'/conn.php';
    $_message =$_POST['message'];
    $sql = "SELECT * FROM About order by id desc limit 1";
    $result = mysqli_query($link,$sql);
    $row = $result->fetch_assoc();
    if(mysqli_num_rows($result)===1){
        $msg = array('message'=>$row['message']);
    }
    echo json_encode(array('msg'=>$msg),JSON_UNESCAPED_UNICODE);
    mysqli_close($link);
