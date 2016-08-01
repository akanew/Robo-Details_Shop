<?php 
	require 'connect.php';

	$fio = $_REQUEST['fio'];
	$phone_number = $_REQUEST['phone_number'];
	$mail_address = $_REQUEST['mail_address'];
	$address = $_REQUEST['address'];
	$card_number = $_REQUEST['card_number'];

	$insert_sql = "INSERT INTO user_data (fio, phone_number, mail_address, address, card_number)" .
	"VALUES('{$fio}', '{$phone_number}', '{$mail_address}', '{$address}', '{$card_number}');";
	mysql_query($insert_sql);

	header('location: http://shop.com/index.html');
	exit();    // прерываем работу скрипта, чтобы забыл о прошлом
?>