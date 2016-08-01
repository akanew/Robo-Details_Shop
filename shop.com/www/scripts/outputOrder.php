<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		
		$sql_select = "SELECT * FROM `order` WHERE order_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);
		
		if($row) { $res=$row['order_id']."|".$row['cart_id']."|"; }
		else { $res="Data error"; }
 
		$accountId=$row['account_id'];
 
		$sql_select_account = "SELECT * FROM account WHERE account_id=$accountId";
		$result_account = mysql_query($sql_select_account);
		$row_account = mysql_fetch_array($result_account);
		
		if($row_account) { $res.=$row_account['login']."|"; }
		else { $res="Data error"; }
		
		$discountId=$row['discount_id'];
		
		$sql_select_discount = "SELECT * FROM discount WHERE discount_id=$discountId";
		$result_discount = mysql_query($sql_select_discount);
		$row_discount = mysql_fetch_array($result_discount);
		
		if($row_discount) { $res.=$row_discount['name']."|".$row_discount['percent']."|"; }
		else { $res.="|0|"; }
		
		$totalPrice=0;
		$flag=false;
		
		if($row['cart_id'] && $flag==false) {
			$cartDataId=$row['cart_id'];
		
			$sql_select_cart = "SELECT * FROM cart WHERE cart_id=$cartDataId";
			$result_cart = mysql_query($sql_select_cart);
			$row_cart = mysql_fetch_array($result_cart);
		
			//Количество товаров
			$array_products_count=$row_cart['array_producrs_count'];
			$productCount = explode(', ', $array_products_count);
			$count=count($productCount);
		
			//Цена товаров
			$array_products_id=$row_cart['array_products_id'];
			$productId = explode(', ', $array_products_id);
		
			for($i=0;(($i<$count) && ($flag==false));$i++) {
				$sql_select_product = "SELECT * FROM `product` WHERE product_id=$productId[$i]";
				$result_product = mysql_query($sql_select_product);
				$row_product = mysql_fetch_array($result_product);
			
				if($row_product) {
					$totalPrice += $row_product['price']*$productCount[$i];							
				}
				else $flag=true;
			}
			
			if($totalPrice) { $res.=$totalPrice."|"; }
			else { $res="Data error"; }
		
			if($totalPrice) { $res.=($totalPrice-(($row_discount['percent']/100)*$totalPrice))."|"; }
			else { $res.=$totalPrice."|"; }
		}

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>