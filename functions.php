<?php
date_default_timezone_set("Asia/Dhaka");
//////////// get category name /////////////////
function get_cat_name($catid,$connect){
	$get_cat_name = mysqli_query($connect,"SELECT * FROM category WHERE id='$catid'");
	$cat_name = mysqli_fetch_array($get_cat_name,MYSQLI_BOTH);
	return $cat_name['name'];
	
}

//////////// get Business name /////////////////
function get_sms($smsid,$connect){
	$get_sms = mysqli_query($connect,"SELECT sms_text FROM sms_in WHERE id='$smsid'") or die(mysqli_error($connect));
	$sms = mysqli_fetch_array($get_sms,MYSQLI_ASSOC);
	return $sms['sms_text'];
	
}



//////////// get meta info for checking if exists/////////////////
function meta_check($bid, $string,$connect){
	$get_meta_check = mysqli_query($connect,"SELECT * FROM biz_meta WHERE bid = '$bid' and lower(attribute) like '%$string%'") or die(mysqli_error($connect));
	return mysqli_num_rows($get_meta_check);
	
}

//////////// get biz permalink/////////////////
function biz_permalink($bid,$connect){
	$get_biz_permalink = mysqli_query($connect,"SELECT * FROM business WHERE id='$bid'");
	$biz_permalink = mysqli_fetch_array($get_biz_permalink,MYSQL_BOTH);
	return $biz_permalink['permalink'];
	
}

/////////////////// get business hours ////////////////
function biz_hours($bid,$day,$col,$connect){
	$get_biz_hours = mysqli_query($connect, "SELECT * FROM biz_hours WHERE biz_id = '$bid' and day='$day'");
	$biz_hours = mysqli_fetch_array($get_biz_hours, MYSQLI_ASSOC);
	return $biz_hours[$col];
}
////////////////// check biz hours initial input //////////
function check_biz_hours($bid,$day,$connect){
	$check_biz = mysqli_query($connect, "SELECT * FROM biz_hours WHERE biz_id = $bid and day = '$day'");
	return mysqli_num_rows($check_biz);
}
function check_type_availablity($type,$connect){
	$get_type_list = mysqli_query($connect, "SELECT * FROM product_type WHERE lower(name) = '$type'");
	return mysqli_num_rows($get_type_list);
}
function get_latest_pro_insert($bid, $connect){
	$get_latest = mysqli_query($connect, "SELECT * FROM products WHERE bid = '$bid' ORDER by id desc limit 1") or die(mysqli_error($connect));
	$latest  = mysqli_fetch_array($get_latest, MYSQLI_ASSOC);
	return $latest['id'];
}
//////////// get reviews ///////////
function reviews($bid,$uid,$connect){
	if($bid!=0){
		$get_reviews = mysqli_query($connect, "SELECT * FROM reviews WHERE bid = $bid");
	}
	else  if($uid!=0){
		$get_reviews = mysqli_query($connect, "SELECT * FROM reviews WHERE reviwer_id = $uid");
	}
	else $get_reviews = mysqli_query($connect, "SELECT * FROM reviews");
	return $get_reviews;
}

///////////// get user info 
 function users_info($uid, $col, $connect){
    	$get_users = mysqli_query($connect, "SELECT * FROM usertable WHERE id = '$uid'");
    	$users = mysqli_fetch_array($get_users, MYSQLI_ASSOC);
    	return $users[$col];
    }

// Get Receiving Number of SMS INBOX
    function rec_info($connect){
        $sql = "SELECT DISTINCT  tag FROM sms_in WHERE sender_number = 'bKash' ";
        $result = mysqli_query($connect, $sql);
        return $result;
    }

// Get Receiving Number of SMS OUTBOX
    function rec_info_outbox($connect){
        $sql = "SELECT DISTINCT  tag FROM sms_in WHERE sender_number = '16216' ";
        $result = mysqli_query($connect, $sql);
        return $result;
    }
?>