<?php
require_once("connection.php");
include("functions.php");


if(isset($_POST["startDate"], $_POST["endDate"]))
{
    $startDate = mysqli_real_escape_string($connect, $_POST["startDate"]);
    $endDate = mysqli_real_escape_string($connect, $_POST["endDate"]);
    $query = "DELETE FROM sms_in WHERE sent_dt BETWEEN '". $startDate ."' AND '". $endDate ."' ";
    if(mysqli_query($connect, $query))
    {
        if(mysqli_affected_rows($connect) > 0){
            echo 'Data deleted Successfully.';
        }else{
            echo 'No Record deleted.';
        }

    }
}





















?>