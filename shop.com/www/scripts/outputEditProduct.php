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
		
		if($discountId) {
			$sql_select = "SELECT * FROM discount WHERE discount_id=$discountId";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			if($row && $res!="Data error") { $res .= "|".$row['discount_id']."|".$row['name']."|"; }
			else { $res="Data error"; }
		} else $res .= "|||";	

		$sql_select_products_group = "SELECT * FROM products_group";
		$result_products_group = mysql_query($sql_select_products_group);
			
		while ($row_products_group = mysql_fetch_array($result_products_group)) {
			$res .= $row_products_group['name']."*";
		}
		$res = substr($res, 0, -1);
		$res .= "|";
		
		$sql_select_products_group = "SELECT * FROM products_group";
		$result_products_group = mysql_query($sql_select_products_group);
			
		while ($row_products_group = mysql_fetch_array($result_products_group)) {
			$res .= $row_products_group['products_group_id']."*";
		}
		$res = substr($res, 0, -1);
		
		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>