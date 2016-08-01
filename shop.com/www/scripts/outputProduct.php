<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$productId=$param->productId;
		$productsGroupId=$param->productsGroupId;
		$discountId=$param->discountId;
		
		$sql_select = "SELECT * FROM product WHERE product_id=$productId";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);

		if($row) {
			$res=$row['product_id']."|".$row['name']."|".$row['price']."|".$row['count']."|".$row['description'];
		}
		else {$res="Data error";}
		
		if($productsGroupId) {
			$sql_select = "SELECT * FROM products_group WHERE products_group_id=$productsGroupId";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			if($row && $res!="Data error") { $res .= "|".$row['products_group_id']."|".$row['name']; }
			else { $res="Data error"; }
		} else $res .= "||";
		
		if($discountId) {
			$sql_select = "SELECT * FROM discount WHERE discount_id=$discountId";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			if($row && $res!="Data error") { $res .= "|".$row['discount_id']."|".$row['name']."|"; }
			else { $res="Data error"; }
		} else $res .= "|||";		

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>