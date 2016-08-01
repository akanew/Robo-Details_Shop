<?php 
	require 'connect.php';

	if($_POST['searchData'])	{
		$searchData = json_decode($_POST['searchData']);

		$fio = $searchData->fio;
		$login = $searchData->login;
		$order_list = $searchData->order_list;
		$cart = $searchData->cart;
		$discount = $searchData->discount;
				
		$arr_fio_id_userDate=array();
		$arr_fio_id=array();
		$fio_cycle=0;
		$arr_login_id=array();
		$login_cycle=0;
		$arr_order_list_id=array();
		$order_list_cycle=0;
		$arr_cart_id=array();
		$cart_cycle=0;
		$arr_discount_id_fromDiscount=array();
		$arr_discount_id=array();
		$discount_cycle=0;
		$result_index_array=array();
		$result_count=0;
		$cycle=0;
		
		if($fio) {
		
			$sql_select = "SELECT * FROM user_data";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $fio)==$row['fio']) {
					$arr_fio_id_userDate[$cycle]=$row['user_id'];
					$cycle++;
				}
			}
			
			$sql_select = "SELECT * FROM account";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$flag=false;
				for ($i=0; $i<$cycle; $i++)
					if(iconv( 'UTF-8','windows-1251', $arr_fio_id_userDate[$i])==$row['user_id']) $flag=true;
				
				if($flag==true) {
					$arr_fio_id[$fio_cycle]=$row['account_id'];
					$fio_cycle++;
				}
			}
		}
		
		/*for ($i=0; $i<$fio_cycle; $i++){
			$res.=$arr_fio_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
/////////////////////////////////////////////////////////////		
		if($login) {
			$sql_select = "SELECT * FROM account";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $login)==$row['login']) {
					$arr_login_id[$login_cycle]=$row['account_id'];
					$login_cycle++;
				}
			}
		}
		
		/*for ($i=0; $i<$login_cycle; $i++){
			$res.=$arr_login_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
///////////////////////////////////////////////////////////////////////
		if($order_list) {
			$sql_select = "SELECT * FROM account";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $order_list)==$row['array_records_id']) {
					$arr_order_list_id[$order_list_cycle]=$row['account_id'];
					$order_list_cycle++;
				}
			}
		}
		
		$res.="(";
		for ($i=0; $i<$order_list_cycle; $i++){
			$res.=$arr_order_list_id[$i]."|";
		}
		$res = substr($res, 0, -1);
		$res.=")";
/////////////////////////////////////////////////////////////		
		if($cart) {
			$sql_select = "SELECT * FROM account";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $cart)==$row['cart_id']) {
					$arr_cart_id[$cart_cycle]=$row['account_id'];
					$cart_cycle++;
				}
			}
		}
		
		/*for ($i=0; $i<$cart_cycle; $i++){
			$res.=$arr_cart_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
///////////////////////////////////////////////////////////////////////
		if($discount) {
		
			$sql_select = "SELECT * FROM discount";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				if(iconv( 'UTF-8','windows-1251', $discount)==$row['name']) {
					$arr_discount_id_fromDiscount[$cycle]=$row['discount_id'];
					$cycle++;
				}
			}
			
			$sql_select = "SELECT * FROM account";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$flag=false;
				for ($i=0; $i<$cycle; $i++)
					if(iconv( 'UTF-8','windows-1251', $arr_discount_id_fromDiscount[$i])==$row['discount_id']) $flag=true;
				
				if($flag==true) {
					$arr_discount_id[$discount_cycle]=$row['account_id'];
					$discount_cycle++;
				}
			}
		}
		
		/*for ($i=0; $i<$discount_cycle; $i++){
			$res.=$arr_discount_id[$i]."|";
		}
		$res = substr($res, 0, -1);*/
////////////////////////////////////////////////////////////////////
		$min=0;
		$max=0;
		if($fio){
			$min=$arr_fio_id[0];
			$max=$arr_fio_id[0];
		}
		else if($login) {
			$min=$arr_login_id[0];
			$max=$arr_login_id[0];
		}
		else if($order_list) {
			$min=$arr_order_list_id[0];
			$max=$arr_order_list_id[0];
		}
		else if($discount) {
			$min=$arr_discount_id[0];
			$max=$arr_discount_id[0];
		}
		else if($cart) {
			$min=$arr_cart_id[0];
			$max=$arr_cart_id[0];
		}
		else {
			$sql_select = "SELECT * FROM account";
			$result = mysql_query($sql_select);
			while ($row = mysql_fetch_array($result)){
				$result_index_array[$result_count]=$row['account_id'];
				$result_count++;
			}
		}
		
		$current_fio_cycle=0;
		$current_login_cycle=0;
		$current_order_list_cycle=0;
		$current_cart_cycle=0;
		$current_discount_cycle=0;
		
		$count_index_array=array();
		$count_index_cycle=0;
		
/////////////////////////////////////
		if($fio)
			for ($i=0; $i<$fio_cycle; $i++){
				if($min>$arr_fio_id[$i])$min=$arr_fio_id[$i];
				if($max<$arr_fio_id[$i])$max=$arr_fio_id[$i];
			}
		if($login)
			for ($i=0; $i<$login_cycle; $i++){
				if($min>$arr_login_id[$i])$min=$arr_login_id[$i];
				if($max<$arr_login_id[$i])$max=$arr_login_id[$i];
			}
		if($order_list)
			for ($i=0; $i<$order_list_cycle; $i++){
				if($min>$arr_order_list_id[$i])$min=$arr_order_list_id[$i];
				if($max<$arr_order_list_id[$i])$max=$arr_order_list_id[$i];
			}
		if($discount)
			for ($i=0; $i<$discount_cycle; $i++){
				if($min>$arr_discount_id[$i])$min=$arr_discount_id[$i];
				if($max<$arr_discount_id[$i])$max=$arr_discount_id[$i];
			}
		if($cart)
			for ($i=0; $i<$cart_cycle; $i++){
				if($min>$arr_cart_id[$i])$min=$arr_cart_id[$i];
				if($max<$arr_cart_id[$i])$max=$arr_cart_id[$i];
			}
///////////////////////////////////////
		
		if($min!=0 && $max!=0) {
		
			if($count_index_cycle==0)
				for($i=$min;$i<=$max;$i++)
					$count_index_array[$i]=0;
					
			for($i=$min;$i<=$max;$i++) {
			
				if($fio && $current_fio_cycle<$fio_cycle) {
					if($i==$arr_fio_id[$current_fio_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_fio_cycle++;
					}
				}
				if($login && $current_login_cycle<$login_cycle) {
					if($i==$arr_login_id[$current_login_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_login_cycle++;
					}
				}
				if($order_list && $current_order_list_cycle<$order_list_cycle) {
					if($i==$arr_order_list_id[$current_order_list_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_order_list_cycle++;
					}
				}
				if($discount && $current_discount_cycle<$discount_cycle) {
					if($i==$arr_discount_id[$current_discount_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_discount_cycle++;
					}
				}
				if($cart && $current_cart_cycle<$cart_cycle) {
					if($i==$arr_cart_id[$current_cart_cycle]) {
						$count_index_array[$count_index_cycle]+=1;
						$current_cart_cycle++;
					}
				}
				$count_index_cycle++;
			}
		}
		
		$res.=$min."*";
		$res.=$max."*|";
		
		for($i=0;$i<$count_index_cycle;$i++) {
			$res.=$count_index_array[$i]."|";
		}
		
		$active_row=0;
		
		if($fio)$active_row++;
		if($login)$active_row++;
		if($order_list)$active_row++;
		if($discount)$active_row++;
		if($cart)$active_row++;
		
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
		
		for($i=0;$i<$result_count;$i++) {
			$sql_select = "SELECT * FROM account WHERE account_id=$result_index_array[$i]";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			$userDataId=$row['user_id'];
			$discountId=$row['discount_id'];
			
			$sql_select_userData = "SELECT * FROM user_data WHERE user_id=$userDataId";
			$result_userData = mysql_query($sql_select_userData);
			$row_userData = mysql_fetch_array($result_userData);
			
			$sql_select_Discount = "SELECT * FROM discount WHERE discount_id=$discountId";
			$result_Discount = mysql_query($sql_select_Discount);
			$row_Discount = mysql_fetch_array($result_Discount);
			
			$res .= $row['account_id']."|".$row_userData['fio']."|".$row['login']."|".$row['password']."|".$row['array_records_id']."|".$row_Discount['name']."|".$row['cart_id']."*";
		}
		$res = substr($res, 0, -1);
			
		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>