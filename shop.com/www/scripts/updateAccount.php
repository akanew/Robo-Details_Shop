<?php 
	require 'connect.php';

	$id = $_REQUEST['id'];
	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
 
	if($login) {
		$update_sql = "UPDATE account SET login='$login' WHERE account_id='$id'";
		mysql_query($update_sql);
	}
	if($password) {
		$update_sql = "UPDATE account SET password='$password' WHERE account_id='$id'";
		mysql_query($update_sql);
	}
 
	header('location: http://shop.com/index.html');
	exit();
?>