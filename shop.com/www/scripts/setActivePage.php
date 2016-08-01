<?php 
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		
		$update_sql = "UPDATE active_page SET active_key='0'";
		mysql_query($update_sql);
		$update_sql = "UPDATE active_page SET active_key='1' WHERE page_id='$id'";
		mysql_query($update_sql);
	}
?>