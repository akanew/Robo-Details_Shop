<?php 
	require 'connect.php';

	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$user_id = $_REQUEST['user'];
	$cart_id='';

	$insert_sql = "INSERT INTO cart ()" .
	"VALUES();";
	mysql_query($insert_sql);
	
	$sql_select = "SELECT * FROM cart";
	$result = mysql_query($sql_select);
	while ($row = mysql_fetch_array($result)){
		$cart_id=$row['cart_id'];
	}

	$insert_sql = "INSERT INTO account (user_id, login, password, cart_id)" .
	"VALUES('{$user_id}', '{$login}', '{$password}', '{$cart_id}');";
	mysql_query($insert_sql);
	
	header('location: http://shop.com/index.html');
	exit();    // прерываем работу скрипта, чтобы забыл о прошлом*/
	/*echo $login;
	echo $password;
	echo $user;*/
?>