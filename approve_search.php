<?php
header('Content-type: application/json');
$id =  $_GET['id'];
$active =  $_GET['active'];
include('connection.php');


if($active == 1)
{
    mysqli_query($connect,"UPDATE sms_in SET approved = 1 WHERE id = $id");
}
else
{
    mysqli_query($connect,"UPDATE sms_in SET approved = 0 WHERE id = $id");
}
mysqli_close($connect);
echo json_encode(['id'=>$id, 'status'=>$active]);


?>