<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		$flag='false';

		$sql_select_order = "SELECT * FROM `order` WHERE order_id=$id";
		$result_order = mysql_query($sql_select_order);
		$row_order = mysql_fetch_array($result_order);
		
		$cartId=$row_order['cart_id'];
		
		
		$sql_select = "SELECT * FROM cart WHERE cart_id=$cartId";
		$result = mysql_query($sql_select);
		
		if($row = mysql_fetch_array($result)) $flag='true';
		
		echo json_encode(iconv('windows-1251', 'UTF-8', $flag));
		exit();
	}
?>