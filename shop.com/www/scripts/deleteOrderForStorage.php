<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;

		echo $id;

		$delete_sql = "DELETE FROM order_for_storage WHERE order_for_storage_id=$id";
		mysql_query($delete_sql);
		
		exit();
	}
?>