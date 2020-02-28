<?php
    include_once dirname(__FILE__).'/conn.php';
    $sql = "SELECT * FROM Message";
    $res = mysqli_query($link,$sql);
    $msg=[];
    while($row = mysqli_fetch_array($res))
	{   
        $str=array('title'=>$row['title'],'data'=>$row['data'],'previewmes'=>$row['previewmes'],'previewimg'=>$row['previewimg'],'message'=>$row['message'],'click'=>$row['click']);
        array_push($msg,$str);
    }
    echo json_encode($msg,JSON_UNESCAPED_UNICODE);
    mysqli_close($link);
?>
