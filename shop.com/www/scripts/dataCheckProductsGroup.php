<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		$flag='false';
		
		$sql_select = "SELECT * FROM products_group WHERE products_group_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);
		
		$array_products_id=$row['array_products_id'];
		$productId = explode(', ', $array_products_id);
		$count=count($productId);
			for($i=0;$i<$count;$i++) {
				$sql_select_product = "SELECT * FROM product WHERE product_id=$productId[$i]";
				$result_product = mysql_query($sql_select_product);				
				if($row_product = mysql_fetch_array($result_product)) $flag='true';
			}
		
		echo json_encode(iconv('windows-1251', 'UTF-8', $flag));
		exit();
	}
?>