<?php 
	require 'connect.php';

	$discount_name = $_REQUEST['discountName'];
	$discount_value = $_REQUEST['discountValue'];
	$discount_type = $_REQUEST['discountType'];
	$discount_object = $_REQUEST['discountObject'];
	$description = $_REQUEST['description'];

	$insert_sql = "INSERT INTO discount (name, percent, type, discount_record_id, description)" .
	"VALUES('{$discount_name}', '{$discount_value}', '{$discount_type}', '{$discount_object}', '{$description}');";
	mysql_query($insert_sql);
	
	$res = mysql_query("SELECT COUNT(*) FROM discount");
	$row = mysql_fetch_row($res);
	$last_record = $row[0];
	
	if($discount_type==1) {
		$update_sql = "UPDATE account SET discount_id='$last_record' WHERE account_id='$discount_object'";
		mysql_query($update_sql);
	}
	if($discount_type==2) {
		$update_sql = "UPDATE `order` SET discount_id='$last_record' WHERE order_id='$discount_object'";
		mysql_query($update_sql);
	}
	if($discount_type==3) {
		$update_sql = "UPDATE product SET discount_id='$last_record' WHERE product_id='$discount_object'";
		mysql_query($update_sql);
	}
		
	

	header('location: http://shop.com/index.html');
	exit();    // прерываем работу скрипта, чтобы забыл о прошлом
?>