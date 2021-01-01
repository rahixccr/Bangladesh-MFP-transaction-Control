<?php
require_once("connection.php");
include("functions.php");


if(isset($_POST["rec_number"], $_POST["sender_number"], $_POST['sms_text']))
{
    $rec_number = mysqli_real_escape_string($connect, $_POST["rec_number"]);
    $sender_number = mysqli_real_escape_string($connect, $_POST["sender_number"]);
    $sms_text = mysqli_real_escape_string($connect, $_POST["sms_text"]);
    $query = "INSERT INTO sms_in(tag, sender_number, sms_text, sent_dt) VALUES('$rec_number', '$sender_number', '$sms_text', CURDATE())";
    if(mysqli_query($connect, $query))
    {
        echo 'Data Inserted';
    }
}





















?>