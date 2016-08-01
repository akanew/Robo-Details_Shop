<?php 
	require 'connect.php';

	if($_POST['searchData'])	{
		$searchData = json_decode($_POST['searchData']);
		
		$cart_id = $searchData->cart_id;
		$order_id = $searchData->order_id;
		$account = $searchData->account;
		$discount = $searchData->discount;
		$price = $searchData->price;
		$total_price = $searchData->total_price;
		
		$result_index_array=array();
		$result_count=0;		
		
		$arr_cart_id=array();
		$cart_id_cycle=0;
		$arr_account_id=array();
		$account_cycle=0;
		$arr_account_id_Account=array();
		$discount_cycle=0;
		$arr_discount_id=array();
		$arr_discount_id_fromDiscount=array();
		$arr_price_value=array();
		$price_value=0;
		$arr_price_id=array();
		$price_id=0;
		$cycle=0;
		$arr_total_price_id=array();
		$total_price_id=0;
		
		
		$sql_select = "SELECT * FROM `order`";
		$result = mysql_query($sql_select);
		
		if($cart_id) {
			while ($row = mysql_fetch_array($result)){
				if($cart_id && iconv( 'UTF-8','windows-1251', $cart_id)==$row['cart_id']) {
					$arr_cart_id[$cart_id_cycle]=$row['order_id'];
					$cart_id_cycle++;
				}
			}
			
			/*for ($i=0; $i<$cart_id_cycle; $i++){
				$res.=$arr_cart_id[$i]."|";
			}
			$res = substr($res, 0, -1);*/
		}
//////////////////////////////////////////////////////////////////////////				
		if($account) {
		
			$sql_select = "SELECT * FROM account";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $account)==$row['login']) {
					$arr_account_id_Account[$cycle]=$row['account_id'];
					$cycle++;
				}
			}
			
			$sql_select = "SELECT * FROM `order`";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$flag=false;
				for ($i=0; $i<$cycle; $i++)
					if(iconv( 'UTF-8','windows-1251', $arr_account_id_Account[$i])==$row['account_id']) $flag=true;
				
				if($flag==true) {
					$arr_account_id[$account_cycle]=$row['order_id'];
					$account_cycle++;
				}
			}
		}
		
		/*for ($i=0; $i<$account_cycle; $i++){
			$res.=$arr_account_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
//////////////////////////////////////////////////////////////////////////
		if($discount) {
		
			$sql_select = "SELECT * FROM discount";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $discount)==$row['name']) {
					$arr_discount_id_fromDiscount[$cycle]=$row['discount_id'];
					$cycle++;
				}
			}
			
			$sql_select = "SELECT * FROM `order`";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$flag=false;
				for ($i=0; $i<$cycle; $i++)
					if(iconv( 'UTF-8','windows-1251', $arr_discount_id_fromDiscount[$i])==$row['discount_id']) $flag=true;
				
				if($flag==true) {
					$arr_discount_id[$discount_cycle]=$row['order_id'];
					$discount_cycle++;
				}
			}
		}
		
		/*for ($i=0; $i<$discount_cycle; $i++){
			$res.=$arr_discount_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
//////////////////////////////////////////////////////////////////////////		
		if($price) {
			
			$tmp_products_price_array=array();
			$tmp_products_price=0;
			
			$tmp_order_id_array=array();
			$tmp_order_id=0;
		
			$sql_select = "SELECT * FROM `order`";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$tmp_order_id_array[$tmp_order_id]=$row['order_id'];
				$tmp_order_id++;
			
				$cartIdFromOrder=$row['cart_id'];
				
				$sql_select_cart = "SELECT * FROM cart WHERE cart_id=$cartIdFromOrder";
				$result_cart = mysql_query($sql_select_cart);
				$row_cart = mysql_fetch_array($result_cart);
				
				$array_products_id=$row_cart['array_products_id'];//Строка списка товаров для текущего заказа
			
				$productId = explode(', ', $array_products_id);
				$count=count($productId);
				for($i=0;$i<$count;$i++) {
					$sql_select_product = "SELECT * FROM product WHERE product_id=$productId[$i]";
					$result_product = mysql_query($sql_select_product);
					$row_product = mysql_fetch_array($result_product);
					
					if($row_product) {						
						$tmp_products_price_array[$tmp_products_price]=$row_product['price'];
						$tmp_products_price++;
					}
				}
				
				$array_products_price=$row_cart['array_producrs_count'];
				$tmp_products_count_array = explode(', ', $array_products_price);
				$count=count($tmp_products_count_array);
				
				$total_price_for_element=0;
				for($i=0;$i<$count;$i++) {
					$total_price_for_element+=$tmp_products_price_array[$i]*$tmp_products_count_array[$i];
				}
				
				$arr_price_value[$price_value]=$total_price_for_element;
				$price_value++;
			}
			/*$res="";
			for($i=0;$i<$price_value;$i++) {
				$res.=$arr_price_value[$i]."+";
			}*/
			
			if($tmp_order_id==$price_value) {
				for($i=0;$i<$tmp_order_id;$i++) {
					if($arr_price_value[$i]==$price) {
						$arr_price_id[$price_id]=$tmp_order_id_array[$i];
						$price_id++;
					}
				}
			}
			
			/*$res="";
			for($i=0;$i<$price_id;$i++) {
				$res.=$arr_price_id[$i]."+";
			}*/
		}
//////////////////////////////////////////////////////////////////////////		
//////////////////////////////////////////////////////////////////////////		
		if($total_price) {
			
			$tmp_products_price_array=array();
			$tmp_products_price=0;
			
			$tmp_order_id_array=array();
			$tmp_order_id=0;
			
			$tmp_discount_id_array=array();
			$tmp_discount_id=0;
		
			$sql_select = "SELECT * FROM `order`";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
			
				$tmp_order_id_array[$tmp_order_id]=$row['order_id'];
				$tmp_order_id++;
				
				if($row['discount_id']) {
					$tmp_discount_id_array[$tmp_discount_id]=$row['discount_id'];
					$tmp_discount_id++;
				}
				else {
					$tmp_discount_id_array[$tmp_discount_id]=0;
					$tmp_discount_id++;
				}
			
				$cartIdFromOrder=$row['cart_id'];
				
				$sql_select_cart = "SELECT * FROM cart WHERE cart_id=$cartIdFromOrder";
				$result_cart = mysql_query($sql_select_cart);
				$row_cart = mysql_fetch_array($result_cart);
				
				$array_products_id=$row_cart['array_products_id'];//Строка списка товаров для текущего заказа
			
				$productId = explode(', ', $array_products_id);
				$count=count($productId);
				for($i=0;$i<$count;$i++) {
					$sql_select_product = "SELECT * FROM product WHERE product_id=$productId[$i]";
					$result_product = mysql_query($sql_select_product);
					$row_product = mysql_fetch_array($result_product);
					
					if($row_product) {						
						$tmp_products_price_array[$tmp_products_price]=$row_product['price'];
						$tmp_products_price++;
					}
				}
				
				$array_products_price=$row_cart['array_producrs_count'];
				$tmp_products_count_array = explode(', ', $array_products_price);
				$count=count($tmp_products_count_array);
				
				$total_price_for_element=0;
				for($i=0;$i<$count;$i++) {
					$total_price_for_element+=$tmp_products_price_array[$i]*$tmp_products_count_array[$i];
				}
				
				$arr_price_value[$price_value]=$total_price_for_element;
				$price_value++;
			}
			/*$res="";
			for($i=0;$i<$price_value;$i++) {
				$res.=$arr_price_value[$i]."+";
			}*/			
			
			/*$res="";
			for($i=0;$i<$tmp_discount_id;$i++) {
				$res.=$tmp_discount_id_array[$i]."+";
			}*/
			
			$tmp_discount_value_array=array();
			$tmp_discount_value=0;
			
			for($i=0;$i<$tmp_discount_id;$i++) {
			
				$sql_select_discount = "SELECT * FROM discount WHERE discount_id=$tmp_discount_id_array[$i]";
				$result_discount = mysql_query($sql_select_discount);
				$row_discount = mysql_fetch_array($result_discount);
				
				$tmp_discount_value_array[$tmp_discount_value]=$row_discount['percent'];
				$tmp_discount_value++;
			}
			
			$arr_total_price_value=array();
			$total_price_value=0;
			
			if($price_value==$tmp_discount_value){
				for($i=0;$i<$tmp_discount_value;$i++) {
					$arr_total_price_value[$total_price_value]=$arr_price_value[$i]-(($arr_price_value[$i]/100)*$tmp_discount_value_array[$i]);
					$total_price_value++;
				}
			}
			
			if($tmp_order_id==$total_price_value) {
				for($i=0;$i<$tmp_order_id;$i++) {
					if($arr_total_price_value[$i]==$total_price) {
						$arr_total_price_id[$total_price_id]=$tmp_order_id_array[$i];
						$total_price_id++;
					}
				}
			}
			
			/*$res="";
			for($i=0;$i<$total_price_value;$i++) {
				$res.=$arr_total_price_value[$i]."+";
			}*/
			
			/*$res="";
			for($i=0;$i<$total_price_id;$i++) {
				$res.=$arr_total_price_id[$i]."+";
			}*/
		}
//////////////////////////////////////////////////////////////////////////		
		$min=0;
		$max=0;
		
		if($cart_id){
			$min=$arr_cart_id[0];
			$max=$arr_cart_id[0];
		}
		else if($account) {
			$min=$arr_account_id[0];
			$max=$arr_account_id[0];
		}
		else if($discount) {
			$min=$arr_discount_id[0];
			$max=$arr_discount_id[0];
		}
		else if($price) {
			$min=$arr_price_id[0];
			$max=$arr_price_id[0];
		}
		else if($total_price) {
			$min=$arr_total_price_id[0];
			$max=$arr_total_price_id[0];
		}
		else if($order_id){
			$orderId=iconv( 'UTF-8','windows-1251', $order_id);
		
			$sql_select = "SELECT * FROM `order` WHERE order_id=$orderId";
			$result = mysql_query($sql_select);

			if($row = mysql_fetch_array($result)) {
				$result_index_array[$result_count]=$row['order_id'];
				$result_count++;
			}
		} 
		else {
			$sql_select = "SELECT * FROM `order`";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$result_index_array[$result_count]=$row['order_id'];
				$result_count++;
			}
		}		
		//////////////////////
		if($cart_id)
			for ($i=0; $i<$cart_id_cycle; $i++){
				if($min>$arr_cart_id[$i])$min=$arr_cart_id[$i];
				if($max<$arr_cart_id[$i])$max=$arr_cart_id[$i];
			}
		if($account)
			for ($i=0; $i<$account_cycle; $i++){
				if($min>$arr_account_id[$i])$min=$arr_account_id[$i];
				if($max<$arr_account_id[$i])$max=$arr_account_id[$i];
			}
		if($discount)
			for ($i=0; $i<$discount_cycle; $i++){
				if($min>$arr_discount_id[$i])$min=$arr_discount_id[$i];
				if($max<$arr_discount_id[$i])$max=$arr_discount_id[$i];
			}
		if($price)
			for ($i=0; $i<$price_id; $i++){
				if($min>$arr_price_id[$i])$min=$arr_price_id[$i];
				if($max<$arr_price_id[$i])$max=$arr_price_id[$i];
			}
		if($total_price)
			for ($i=0; $i<$total_price_id; $i++){
				if($min>$arr_total_price_id[$i])$min=$arr_total_price_id[$i];
				if($max<$arr_total_price_id[$i])$max=$arr_total_price_id[$i];
			}
			
		$current_cart_id_cycle=0;
		$current_account_cycle=0;
		$current_discount_cycle=0;
		$current_price_cycle=0;
		$current_total_price_cycle=0;
		
		$count_index_array=array();
		$count_index_cycle=0;
		
		if($min!=0 && $max!=0) {
		
			if($count_index_cycle==0)
				for($i=$min;$i<=$max;$i++)
					$count_index_array[$i]=0;
					
			for($i=$min;$i<=$max;$i++) {
			
				if($cart_id && $current_cart_id_cycle<$cart_id_cycle) {
					if($i==$arr_cart_id[$current_cart_id_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_cart_id_cycle++;
					}
				}
				if($account && $current_account_cycle<$account_cycle) {
					if($i==$arr_account_id[$current_account_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_account_cycle++;
					}
				}
				if($discount && $current_discount_cycle<$discount_cycle) {
					if($i==$arr_discount_id[$current_discount_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_discount_cycle++;
					}
				}
				if($price && $current_price_cycle<$price_id) {
					if($i==$arr_price_id[$current_price_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_price_cycle++;
					}
				}
				if($total_price && $current_total_price_cycle<$total_price_id) {
					if($i==$arr_total_price_id[$current_total_price_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_total_price_cycle++;
					}
				}
				$count_index_cycle++;
			}
		}
		
		if($order_id) {
			for($i=$min;$i<=$max;$i++) {
				if(($order_id-1)==$i) {
					$count_index_array[$i]+=1;
				}
			}
		}		
				
		/*for($i=0;$i<$count_index_cycle;$i++) {
			$res.=$count_index_array[$i]."|";
		}*/
		
		$active_row=0;		
		if($order_id)$active_row++;
		if($cart_id)$active_row++;
		if($account)$active_row++;
		if($discount)$active_row++;
		if($price)$active_row++;
		if($total_price)$active_row++;
		
		for($i=0;$i<$count_index_cycle;$i++) {
			if($count_index_array[$i]==$active_row) {
				$result_index_array[$result_count]=$min+$i;
				$result_count++;
			}
		}

		/*$res="";
		for($i=0;$i<$result_count;$i++) {
			$res.=$result_index_array[$i]."|";
		}
		$res = substr($res, 0, -1);*/
		
		//Нужно вывести данные из БД order с индексами хранящимися в $result_index_array[$i]
		for($k=0;$k<$result_count;$k++) {
			$sql_select = "SELECT * FROM `order` WHERE order_id=$result_index_array[$k]";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			$accountId=$row['account_id'];
			$discountId=$row['discount_id'];
			$cartId=$row['cart_id'];
			
			$sql_select_account = "SELECT * FROM account WHERE account_id=$accountId";
			$result_account = mysql_query($sql_select_account);
			$row_account = mysql_fetch_array($result_account);
			
			$sql_select_Discount = "SELECT * FROM discount WHERE discount_id=$discountId";
			$result_Discount = mysql_query($sql_select_Discount);
			$row_Discount = mysql_fetch_array($result_Discount);
			
			$sql_select_cart = "SELECT * FROM cart WHERE cart_id=$cartId";
			$result_cart = mysql_query($sql_select_cart);
			$row_cart = mysql_fetch_array($result_cart);
			
			$tmp_products_price_array=array();
			$tmp_products_price=0;
			$tmp_products_count_array=array();
			$tmp_products_count_=0;
			
			$array_products_id=$row_cart['array_products_id'];//Строка списка товаров для текущего заказа			
			$productId = explode(', ', $array_products_id);
			$count=count($productId);
			for($i=0;$i<$count;$i++) {
				$sql_select_product = "SELECT * FROM product WHERE product_id=$productId[$i]";
				$result_product = mysql_query($sql_select_product);
				$row_product = mysql_fetch_array($result_product);
					
				if($row_product) {						
					$tmp_products_price_array[$tmp_products_price]=$row_product['price'];
					$tmp_products_price++;
				}
				else {
					$tmp_products_price_array[$tmp_products_price]=0;
					$tmp_products_price++;
				}
			}
			
			$array_products_price=$row_cart['array_producrs_count'];
			$tmp_products_count_array = explode(', ', $array_products_price);
			$count=count($tmp_products_count_array);
				
			$total_price_for_element=0;
			for($i=0;$i<$count;$i++) {
				$total_price_for_element+=$tmp_products_price_array[$i]*$tmp_products_count_array[$i];
			}
			
			$total_price_for_element_with_discount=0;
			if($row_Discount['percent']!=0) {
				$total_price_for_element_with_discount=$total_price_for_element-(($total_price_for_element/100)*$row_Discount['percent']);
			}
			
			$res .=  $row['order_id']."|".$row['cart_id']."|".$row_account['login']."|".$row_Discount['name']."|".$total_price_for_element."|".$total_price_for_element_with_discount."*";
		}
		$res = substr($res, 0, -1);
		
		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>