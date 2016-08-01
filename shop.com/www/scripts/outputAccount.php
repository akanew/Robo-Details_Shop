<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$accountId=$param->accountId;
		$userId=$param->userId;
		$discountId=$param->discountId;
		
		$sql_select = "SELECT * FROM user_data WHERE user_id=$userId";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);
		
		if($row) { $res=$row['user_id']."|".$row['fio']."|"; }
		else { $res="Data error"; }
 
		$sql_select = "SELECT * FROM account WHERE account_id=$accountId";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);

		if($row && $res!="Data error") {
			$res .= $row['account_id']."|".$row['login']."|".$row['password']."|".$row['array_records_id']."|".$row['cart_id'];
		}
		else {$res="Data error";}
		
		if($discountId) {
			$sql_select = "SELECT * FROM discount WHERE discount_id=$discountId";
			$result = mysql_query($sql_select);
			$row = mysql_fetch_array($result);
			
			if($row && $res!="Data error") { $res .= "|".$row['discount_id']."|".$row['name']."|"; }
			else { $res="Data error"; }
		} else $res .= "|||";

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>