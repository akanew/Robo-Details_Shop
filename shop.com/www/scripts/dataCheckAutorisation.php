<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		$flag='false';
		
		$sql_select = "SELECT * FROM autorisation WHERE status='1'";
		$result = mysql_query($sql_select);
		
		if($row = mysql_fetch_array($result)) $flag='true';
		
		echo json_encode(iconv('windows-1251', 'UTF-8', $flag));
		exit();
	}
?>