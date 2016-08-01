<?php
	require 'connect.php';

	if($_POST['data'])	{
		$data = json_decode($_POST['data']);
		$id=$data->id;
		
		$res = mysql_query("SELECT COUNT(*) FROM `storage`");
		$row = mysql_fetch_row($res);
		$res = $row[0];
		
		$sql_select = "SELECT * FROM `storage`";
		$result = mysql_query($sql_select);
		
		while ($row = mysql_fetch_array($result)){
			$res .= "|".$row['name'];
		}
		
		if(!$res) $res="Data error";

		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>