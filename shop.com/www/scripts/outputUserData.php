<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
 
		$sql_select = "SELECT * FROM user_data WHERE user_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);

		if($row) {
			$res=$row['fio']."|".$row['phone_number']."|".$row['mail_address']."|".$row['address']."|".$row['card_number']."|".$row['user_id'];
		}
		else {$res="Data error";}

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>