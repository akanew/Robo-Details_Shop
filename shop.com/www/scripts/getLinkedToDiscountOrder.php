<?php
	require 'connect.php';

	if($_POST['data'])	{
		$data = json_decode($_POST['data']);
		$id=$data->id;
		
		$res = mysql_query("SELECT COUNT(*) FROM `order`");
		$row = mysql_fetch_row($res);
		$res = $row[0];
		
		$sql_select = "SELECT * FROM `order`";
		$result = mysql_query($sql_select);
		
		while ($row = mysql_fetch_array($result)){
			$res .= "|".$row['order_id'];
		}
		
		$sql_select = "SELECT * FROM discount WHERE discount_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);		
		
		$res .= "|".$row['discount_record_id'];
	
		if(!$res) $res="Data error";

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>