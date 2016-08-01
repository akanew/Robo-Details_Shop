<?php 
	require 'connect.php';

	$id = $_REQUEST['id'];
	$discount_name = $_REQUEST['discountName'];
	$discount_value = $_REQUEST['discountValue'];
	$discount_type = $_REQUEST['discountType'];
	$discount_object = $_REQUEST['discountObject'];
	$description = $_REQUEST['description'];
 
	if($discount_name) {
		$update_sql = "UPDATE discount SET name='$discount_name' WHERE discount_id='$id'";
		mysql_query($update_sql);
	}
	if($discount_value) {
		$update_sql = "UPDATE discount SET percent='$discount_value' WHERE discount_id='$id'";
		mysql_query($update_sql);
	}
	if($discount_type) {
		$update_sql = "UPDATE discount SET type='$discount_type' WHERE discount_id='$id'";
		mysql_query($update_sql); 
	}
	if($discount_object) {
		$update_sql = "UPDATE discount SET discount_record_id='$discount_object' WHERE discount_id='$id'";
		mysql_query($update_sql);
	}
	if($description) {
		$update_sql = "UPDATE discount SET description='$description' WHERE discount_id='$id'";
		mysql_query($update_sql);
	}
	
	header('location: http://shop.com/index.html');
	exit();
?>