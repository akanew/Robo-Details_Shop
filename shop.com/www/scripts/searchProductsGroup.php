<?php 
	require 'connect.php';

	if($_POST['searchData'])	{
		$searchData = json_decode($_POST['searchData']);
		
		$products_group = $searchData->products_group;
		$products_list = $searchData->products_list;
		$storage = $searchData->storage;
		
		$storage_cycle=0;
		$arr_storage_id=array();
		$arr_storage_id_fromStorage=array();
		$cycle=0;
		$products_list_cycle=0;
		$arr_products_list_id=array();
		$arr_products_group_name=array();
		$products_group_name_cycle=0;
		
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
		
		//////////////////////////////////////////////////////////////////////////
		if($storage) {
		
			$sql_select = "SELECT * FROM `storage`";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $storage)==$row['name']) {
					$arr_storage_id_fromStorage[$cycle]=$row['storage_id'];
					$cycle++;
				}
			}
			
			$sql_select = "SELECT * FROM products_group";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$flag=false;
				for ($i=0; $i<$cycle; $i++)
					if(iconv( 'UTF-8','windows-1251', $arr_storage_id_fromStorage[$i])==$row['storage_id']) $flag=true;
				
				if($flag==true) {
					$arr_storage_id[$storage_cycle]=$row['products_group_id'];
					$storage_cycle++;
				}
			}
		}
		/*$res="";
		for ($i=0; $i<$storage_cycle; $i++){
			$res.=$arr_storage_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
		
		if($products_list) {
		
			$sql_select = "SELECT * FROM products_group";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $products_list)==$row['array_products_id']) {
					$arr_products_list_id[$products_list_cycle]=$row['products_group_id'];
					$products_list_cycle++;
				}
			}
		}
		/*$res="";
		for ($i=0; $i<$products_list_cycle; $i++){
			$res.=$arr_products_list_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
		
		if($products_group) {
		
			$sql_select = "SELECT * FROM products_group";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $products_group)==$row['name']) {
					$arr_products_group_name[$products_group_name_cycle]=$row['products_group_id'];
					$products_group_name_cycle++;
				}
			}
		}
		/*$res="";
		for ($i=0; $i<$products_group_name_cycle; $i++){
			$res.=$arr_products_group_name[$i]."|";
		}
		$res = substr($res, 0, -1);*/
		
		$min=0;
		$max=0;
		if($products_group){
			$min=$arr_products_group_name[0];
			$max=$arr_products_group_name[0];
		}
		else if($products_list) {
			$min=$arr_products_list_id[0];
			$max=$arr_products_list_id[0];
		}
		else if($storage) {
			$min=$arr_storage_id[0];
			$max=$arr_storage_id[0];
		}
		else {
			$sql_select = "SELECT * FROM products_group";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$result_index_array[$result_count]=$row['products_group_id'];
				$result_count++;
			}
		}
		
		if($products_group)
			for ($i=0; $i<$products_group_name_cycle; $i++){
				if($min>$arr_products_group_name[$i])$min=$arr_products_group_name[$i];
				if($max<$arr_products_group_name[$i])$max=$arr_products_group_name[$i];
			}
		if($products_list)
			for ($i=0; $i<$products_list_cycle; $i++){
				if($min>$arr_products_list_id[$i])$min=$arr_products_list_id[$i];
				if($max<$arr_products_list_id[$i])$max=$arr_products_list_id[$i];
			}
		if($storage)
			for ($i=0; $i<$storage_cycle; $i++){
				if($min>$arr_storage_id[$i])$min=$arr_storage_id[$i];
				if($max<$arr_storage_id[$i])$max=$arr_storage_id[$i];
			}
			
		$current_group_name_cycle=0;
		$current_products_list_cycle=0;
		$current_storage_cycle=0;
		
		$count_index_array=array();
		$count_index_cycle=0;		
		
		if($min!=0 && $max!=0 && $max!=$min) {
		
			if($count_index_cycle==0)
				for($i=$min;$i<=$max;$i++)
					$count_index_array[$i]=0;
					
			for($i=$min;$i<=$max;$i++) {
			
				if($products_group && $current_group_name_cycle<$products_group_name_cycle) {
					if($i==$arr_products_group_name[$current_group_name_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_group_name_cycle++;
					}
				}
				if($products_list && $current_products_list_cycle<$products_list_cycle) {
					if($i==$arr_products_list_id[$current_products_list_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_products_list_cycle++;
					}
				}
				if($storage && $current_storage_cycle<$storage_cycle) {
					if($i==$arr_storage_id[$current_storage_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_storage_cycle++;
					}
				}
				$count_index_cycle++;
			}
		}
		
		if($max==$min && $products_group) {
			$result_index_array[$result_count]=$min;
			$result_count++;
		}
		
		$res="";
		for($i=0;$i<$count_index_cycle;$i++) {
			$res.=$count_index_array[$i]."|";
		}
		
		$active_row=0;
		
		if($products_group)$active_row++;
		if($products_list)$active_row++;
		if($storage)$active_row++;
		
		for($i=0;$i<$count_index_cycle;$i++) {
			if($count_index_array[$i]==$active_row) {
				$result_index_array[$result_count]=$min+$i;
				$result_count++;
			}
		}
		
		/*$res="";
		for($i=0;$i<$result_count;$i++) {
			$res.=$result_index_array[$i]."|";
		}*/
		
		$res="";		
		for($k=0;$k<$result_count;$k++) {
			$sql_select = "SELECT * FROM products_group WHERE products_group_id=$result_index_array[$k]";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			$storageId=$row['storage_id'];
			
			$sql_select_storage = "SELECT * FROM storage WHERE storage_id=$storageId";
			$result_storage = mysql_query($sql_select_storage);
			$row_storage = mysql_fetch_array($result_storage);
			
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
			
			$res .= "|".$row['array_products_count'];
			$res .= "|".$row_storage['name']."<>";
		}
		$res = substr($res, 0, -2);
		

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>