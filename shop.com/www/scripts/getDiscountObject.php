<?php
	require 'connect.php';

	if($_POST['data'])	{
		$data = json_decode($_POST['data']);
		$type=$data->type;
		$id=$data->id;
		
		if($type==1) {
			$sql_select = "SELECT * FROM `account` WHERE account_id=$id";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);

			if($row) {
				$res=$row['login'];
			}
			else {$res="Data error";}
		}
		if($type==2) {
			$sql_select = "SELECT * FROM `order` WHERE order_id=$id";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);

			if($row) {
				$res=$row['order_id'];
			}
			else {$res="Data error";}
		}
		if($type==3) {
			$sql_select = "SELECT * FROM `product` WHERE product_id=$id";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);

			if($row) {
				$res=$row['name'];
			}
			else {$res="Data error";}
		}

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>