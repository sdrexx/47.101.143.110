<?php 
    include_once dirname(__FILE__).'/conn.php';
    $sql = "SELECT * FROM `lists`";
    $result=mysqli_query($link,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $msg[]=$row;
        }
    }
    else{
        $msg=null;
    }
    echo json_encode(array('msg'=>$msg),JSON_UNESCAPED_UNICODE);
?>