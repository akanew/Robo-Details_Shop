<?php
	require 'connect.php';

	if($_POST['data'])	{
		$data = json_decode($_POST['data']);
		$id=$data->id;
		
		$res = mysql_query("SELECT COUNT(*) FROM `product`");
		$row = mysql_fetch_row($res);
		$res = $row[0]."|";
		
		$sql_select = "SELECT * FROM `product`";
		$result = mysql_query($sql_select);
		
		while ($row = mysql_fetch_array($result)){
			$res .= $row['name']."*";
		}
		$res = substr($res, 0, -1);
		
		$res .= "|";
		
		$sql_select = "SELECT * FROM `product`";
		$result = mysql_query($sql_select);
		
		while ($row = mysql_fetch_array($result)){
			$res .= $row['product_id']."*";
		}
		$res = substr($res, 0, -1);
		
		$sql_select = "SELECT * FROM discount WHERE discount_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);
		
		
		$res .= "|".$row['discount_record_id'];
		
		if(!$res) $res="Data error";

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>