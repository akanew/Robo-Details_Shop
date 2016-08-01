<?php 
	require 'connect.php';

	$id = $_REQUEST['id'];
	$fio = $_REQUEST['fio'];
	$phone_number = $_REQUEST['phone_number'];
	$mail_address = $_REQUEST['mail_address'];
	$address = $_REQUEST['address'];
	$card_number = $_REQUEST['card_number'];
 
	if($fio) {
		$update_sql = "UPDATE user_data SET fio='$fio' WHERE user_id='$id'";
		mysql_query($update_sql);
	}
	if($phone_number) {
		$update_sql = "UPDATE user_data SET phone_number='$phone_number' WHERE user_id='$id'";
		mysql_query($update_sql);
	}
	if($mail_address) {
		$update_sql = "UPDATE user_data SET mail_address='$mail_address' WHERE user_id='$id'";
		mysql_query($update_sql); 
	}
	if($address) {
		$update_sql = "UPDATE user_data SET address='$address' WHERE user_id='$id'";
		mysql_query($update_sql);
	}
	if($card_number) {
		$update_sql = "UPDATE user_data SET card_number='$card_number' WHERE user_id='$id'";
		mysql_query($update_sql);
	}
 
	header('location: http://shop.com/index.html');
	exit();
?>