<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
 
		$sql_select = "SELECT * FROM order_for_storage WHERE order_for_storage_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);
		
		$storageDataId=$row['storage_id'];
 
		$sql_select_storage = "SELECT * FROM storage WHERE storage_id=$storageDataId";
		$result_storage = mysql_query($sql_select_storage);
		$row_storage = mysql_fetch_array($result_storage);
		
		if($row) {
			$res=$row['order_for_storage_id']."|";
			//
			
			$sql_select_storage2 = "SELECT * FROM storage";
			$result_storage2 = mysql_query($sql_select_storage2);
			while ($row_storage2 = mysql_fetch_array($result_storage2)){
				$res .= $row_storage2['storage_id']."*";
			}
			$res = substr($res, 0, -1);
			$res .= "|";
			
			$sql_select_storage2 = "SELECT * FROM storage";
			$result_storage2 = mysql_query($sql_select_storage2);
			while ($row_storage2 = mysql_fetch_array($result_storage2)){
				$res .= $row_storage2['name']."*";
			}
			$res = substr($res, 0, -1);
			$res .= "|";
			
			$res.=$row['storage_id']."|";
			
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
			
			////////////////////////////////
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
			//$rest = substr("abcdef", 0, -1);  // возвращает "abcde"
			$res = substr($res, 0, -1);
			/////////////////////////////////
			
			$res .= "|".$row['array_products_count'];
			$res .= "|".$row['order_date'];
			$res .= "|".$row['agent'];
		}
		else {$res="Data error";}

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>