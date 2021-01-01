<?php
session_start();
$connects = new PDO("mysql:host=localhost;dbname=sparkitb_smsdb", "sparkitb_sadmin", "spark1tl9941992");

include("functions.php");

$columns = array('time', 'sender' , 'amount', 't_id', 'rec_number', 'Approval'  ,'Action');

if(isset($_POST['rec_num'])){
    $_SESSION["rec_number"] = $_POST['rec_num'];
}


if(isset($_GET['cid'])){
    $query = "
SELECT * FROM sms_in  WHERE category = '$_GET[cid]' AND sender_number = '16216'
";

}elseif(isset($_POST['is_date_search']) == "yes" && $_POST['start_date'] != null)
{
    $query = "
SELECT * FROM sms_in WHERE sender_number = '16216'
";
}
else {
    $query = "
SELECT * FROM sms_in WHERE sent_dt = CURDATE() AND sender_number = '16216'
";
}


if(isset($_POST['is_date_search']) == "yes" && $_POST['start_date'] != null)
{
    $query .= '
 AND sent_dt = "'.$_POST['start_date'].'" ';
}

if(isset($_POST['is_date_search']) == "yes" && !empty($_POST['rec_num']))
{
    $arrImploded = implode(',', $_POST['rec_num'] );
    $query .= ' AND tag IN ('. $arrImploded .') ';

}

if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))
{
    $query .= '
 WHERE tag LIKE "%'.$_POST["search"]["value"].'%" OR sms_text LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST['order']))
{
    $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connects->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connects->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();

foreach($result as $row)
{
    preg_match_all ("/.*?\\d+.*?(\\d+).*?([+-]?\\d*\\.\\d+)(?![-+0-9\\.]).*?\\d+.*?\\d+.*?\\d+.*?\\d+.*?\\d+.*?(\\d+).*?((?:(?:\\d{1}\\d{1}))[-:\\/.](?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Sept|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)[-:\\/.](?:(?:[0-2]?\\d{1})|(?:[3][01]{1})))(?![\\d])(\\s+)((?:(?:[0-1][0-9])|(?:[2][0-3])|(?:[0-9])):(?:[0-5][0-9])(?::[0-5][0-9])?(?:\\s?(?:am|AM|pm|PM))?)/is", $row["sms_text"], $m);

    $sub_array = array();
    $sub_array[] = implode(" ", array($m[4][0],$m[6][0]));
    $sub_array[] = $m[1][0];
    $sub_array[] = $m[2][0];
    $sub_array[] = $m[3][0];
    $sub_array[] = $row['tag'];
    $sub_array[] = $row['sms_text'];
    if($row['approved'] == 0){
        $sub_array[] = '<input type="checkbox" class="toggle-two stat" data-on="Approved" data-off="Pending" data-toggle="toggle" data-onstyle="info" data-offstyle="warning" data-id="'.$row["id"].'" data-status="1" value="Active">';
    }else{
        $sub_array[] = '<input type="checkbox" class="toggle-two stat" data-on="Approved" data-off="Pending" checked data-toggle="toggle" data-onstyle="info" data-offstyle="warning" data-id="'.$row["id"].'" data-status="0" value="Inctive">';
    }
    $sub_array[] = '<button type="button" class="btn btn-success detail">Details</button> ';
    $data[] = $sub_array;
}

function count_all_data($connects)
{
    $query = "SELECT * FROM sms_in WHERE sender_number ='16216'";
    $statement = $connects->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    "draw"       =>  intval($_POST["draw"]),
    "recordsTotal"   =>  count_all_data($connects),
    "recordsFiltered"  =>  $number_filter_row,
    "data"       =>  $data
);

echo json_encode($output);

?>
