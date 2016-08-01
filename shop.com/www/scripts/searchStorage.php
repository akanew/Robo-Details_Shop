<?php 
	require 'connect.php';

	if($_POST['searchData'])	{
		$searchData = json_decode($_POST['searchData']);
		
		$storage = $searchData->storage;
		$products_list = $searchData->products_list;
		
		$result_index_array=array();
		$result_count=0;
		
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
		
		$res="";
		if($products_list && $storage) {
	
			$sql_select = "SELECT * FROM storage";
			$result = mysql_query($sql_select);
			
			while ($row = mysql_fetch_array($result)){
				if((iconv( 'UTF-8','windows-1251', $products_list)==$row['array_products_id'])&& (iconv( 'UTF-8','windows-1251', $storage)==$row['name'])){
					$result_index_array[$result_count]=$row['storage_id'];
					$result_count++;
				}
			}
		}
		else if($products_list) {
						
			$sql_select = "SELECT * FROM storage";
			$result = mysql_query($sql_select);
			
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $products_list)==$row['array_products_id']){
					$result_index_array[$result_count]=$row['storage_id'];
					$result_count++;
				}
			}

		}
		else if($storage) {
			$sql_select = "SELECT * FROM storage";
			$result = mysql_query($sql_select);
			
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $storage)==$row['name']){
					$result_index_array[$result_count]=$row['storage_id'];
					$result_count++;
				}
			}
		}
		else {
			$sql_select = "SELECT * FROM storage";
			$result = mysql_query($sql_select);
			
			while ($row = mysql_fetch_array($result)){
					$result_index_array[$result_count]=$row['storage_id'];
					$result_count++;
			}
		}
				
		/*$res="";
		for($i=0;$i<$result_count;$i++) {
			$res.=$result_index_array[$i]."|";
		}*/
		
		for($k=0;$k<$result_count;$k++) {
			$sql_select = "SELECT * FROM storage WHERE storage_id=$result_index_array[$k]";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			$res .= $row['name']."|";
			
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
			
			$res .= "|".$row['array_products_count']."<>";
		}
		$res = substr($res, 0, -2);

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>