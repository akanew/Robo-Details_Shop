<?php 
	require 'connect.php';

	if($_POST['searchData'])	{
		$searchData = json_decode($_POST['searchData']);
		
		$cart_id = $searchData->cart_id;
		$products_list = $searchData->products_list;
		
		//Преобразование строки с именами товаров в строку с их индексами
		if($products_list)
		{
			$array_id_for_products_list=array();
			$count_id_for_products_list=0;
			
			$productTextElement = explode(', ', $products_list);
			$countTextElement=count($productTextElement);
			$count_Numbers=0;
			
			for($i=0;$i<$countTextElement;$i++) {
				if(is_numeric($productTextElement[$i])) $count_Numbers++;
			}
			
			if($count_Numbers!=$countTextElement) {//В строке имеется текст
				
				for($i=0;$i<$countTextElement;$i++) {
					$sql_select_product = "SELECT * FROM product";
					$result_product = mysql_query($sql_select_product);
					while($row_product = mysql_fetch_array($result_product)) {
						if(iconv( 'UTF-8','windows-1251', $productTextElement[$i])==$row_product['name']) {
							$array_id_for_products_list[$count_id_for_products_list]=$row_product['product_id'];
							$count_id_for_products_list++;
						}
					}
				}
				
				if($countTextElement==$count_id_for_products_list) {
					$products_list="";
					for($i=0;$i<$count_id_for_products_list;$i++) {
						$products_list=$products_list.$array_id_for_products_list[$i].", ";
					}
					$products_list = substr($products_list, 0, -2);
				}
			}
			
		}

		$arr_cart_id=array();
		$arr_products_list=array();
		$result_array=array();
		$count_index_array=array();
		$cart_id_cycle=0;
		$products_list_cycle=0;
		$count_index_cycle=0;
		
		$sql_select = "SELECT * FROM cart";
		$result = mysql_query($sql_select);
		
		while ($row = mysql_fetch_array($result)){
			if($products_list && iconv( 'UTF-8','windows-1251', $products_list)==$row['array_products_id']) {
				$arr_products_list[$products_list_cycle]=$row['cart_id'];
				$products_list_cycle++;
			}
		}
		
		if($cart_id && $products_list) {
			$sql_select = "SELECT * FROM cart WHERE cart_id=$cart_id";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);

			$res.=$row['cart_id']."|";
			
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
		else if($products_list) {
			for($i=0;$i<$products_list_cycle;$i++) {
				$sql_select = "SELECT * FROM cart WHERE cart_id=$arr_products_list[$i]";
				$result = mysql_query($sql_select);
				$row = mysql_fetch_array($result);
				$res.=$row['cart_id']."|";
				//////////////////////////
				$array_products_id=$row['array_products_id'];
			
				$productId = explode(', ', $array_products_id);
				$count=count($productId);
				for($j=0;$j<$count;$j++) {
					$sql_select_product = "SELECT * FROM product WHERE product_id=$productId[$j]";
					$result_product = mysql_query($sql_select_product);
					$row_product = mysql_fetch_array($result_product);
					
					if($row_product) {
						$res .= $row_product['name']."*";
					}
					else $res .= "*";
				}
				if($row_product) $res = substr($res, 0, -1);
				$res .= "|".$row['array_producrs_count'];
				$res.="<>";
			}
			$res = substr($res, 0, -2);
			
		}
		else if($cart_id) {
			$sql_select = "SELECT * FROM cart WHERE cart_id=$cart_id";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);

			$res.=$row['cart_id']."|";
			
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

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>