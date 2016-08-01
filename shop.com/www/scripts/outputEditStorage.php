<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
 
		$sql_select = "SELECT * FROM storage WHERE storage_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);

		if($row) {
			$res=$row['storage_id']."|".$row['name']."|";
			
			$sql_select_product = "SELECT * FROM product";
			$result_product = mysql_query($sql_select_product);
			
			while ($row_product = mysql_fetch_array($result_product)) {
				$res .= $row_product['name']."*";
			}
			$res = substr($res, 0, -1);
			$res .= "|";
			$sql_select_product = "SELECT * FROM product";
			$result_product = mysql_query($sql_select_product);
			
			while ($row_product = mysql_fetch_array($result_product)) {
				$res .= $row_product['product_id']."*";
			}
			$res = substr($res, 0, -1);
			///////////////////////////////
			$res .= "|";

			$array_products_id=$row['array_products_id'];
			
			$productId = explode(', ', $array_products_id);
			$count=count($productId);
			for($i=0;$i<$count;$i++) {
				$sql_select_product = "SELECT * FROM product WHERE product_id=$productId[$i]";
				$result_product = mysql_query($sql_select_product);
				$row_product = mysql_fetch_array($result_product);
				$res .= $row_product['product_id']."*";
			}
			$res = substr($res, 0, -1);
			////////////////////////////
			
			$res .= "|".$row['array_products_count'];
		}
		else {$res="Data error";}

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>