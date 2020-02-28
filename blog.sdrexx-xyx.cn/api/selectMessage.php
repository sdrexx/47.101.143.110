<?php
    include_once dirname(__FILE__).'/conn.php';
    $msg = '';
    $_data=$_POST['data'];
    $sql = "SELECT * FROM Message WHERE data = '$_data'";
    $result = mysqli_query($link,$sql);
    $row = $result->fetch_assoc();
    if(mysqli_num_rows($result)===1){
        $msg = array('title'=>$row['title'],'data'=>$row['data'],'message'=>$row['message'],'previewmes'=>$row['previewmes'],'previewimg'=>$row['previewimg'],'click' => $row['click']);
     }
    echo json_encode(array('msg'=>$msg),JSON_UNESCAPED_UNICODE);
?>
