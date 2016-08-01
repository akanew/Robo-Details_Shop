<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
 
		$sql_select = "SELECT * FROM cart WHERE cart_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);

		if($row) {
			$res=$row['cart_id']."|";
			$array_products_id=$row['array_products_id'];
			
			$productId = explode(', ', $array_products_id);
			$count=count($productId);
			for($i=0;$i<$count;$i++) {
				$sql_select_product = "SELECT * FROM product WHERE product_id=$productId[$i]";
				$result_product = mysql_query($sql_select_product);
				$row_product = mysql_fetch_array($result_product);
				
				if($row_product) {
					$res .= $row_product['name']."*";
				}
				else $res .= "*";
			}
			//$rest = substr("abcdef", 0, -1);  // возвращает "abcde"
			if($row_product) $res = substr($res, 0, -1);
			
			$res .= "|".$row['array_producrs_count'];
		}
		else {$res="Data error";}

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>