<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		echo $id;
		
		$arr_acount_id=array();
		$arr_order_id=array();
		$arr_product_id=array();
		$account_cycle=0;
		$order_cycle=0;
		$product_cycle=0;
		$space=0;
		
		$sql_select = "SELECT * FROM account WHERE discount_id=$id";
		$result = mysql_query($sql_select);		
		
		while ($row = mysql_fetch_array($result)){
			$arr_acount_id[$account_cycle]=$row['account_id'];
			$account_cycle++;
		}
		
		$sql_select = "SELECT * FROM `order` WHERE discount_id=$id";
		$result = mysql_query($sql_select);		
		
		while ($row = mysql_fetch_array($result)){
			$arr_order_id[$order_cycle]=$row['order_id'];
			$order_cycle++;
		}

		$sql_select = "SELECT * FROM `product` WHERE discount_id=$id";
		$result = mysql_query($sql_select);		
		
		while ($row = mysql_fetch_array($result)){
			$arr_product_id[$product_cycle]=$row['product_id'];
			$product_cycle++;
		}
		
		for($i=0;$i<$account_cycle;$i++) {
			$update_sql = "UPDATE account SET discount_id=$space WHERE account_id='$arr_acount_id[$i]'";
			mysql_query($update_sql);
		}
		
		for($i=0;$i<$order_cycle;$i++) {
			$update_sql = "UPDATE `order` SET discount_id=$space WHERE order_id='$arr_order_id[$i]'";
			mysql_query($update_sql);
		}
		
		for($i=0;$i<$product_cycle;$i++) {
			$update_sql = "UPDATE `product` SET discount_id=$space WHERE product_id='$arr_product_id[$i]'";
			mysql_query($update_sql);
		}

		exit();
	}
?>