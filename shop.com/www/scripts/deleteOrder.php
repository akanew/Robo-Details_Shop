<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$row=$param->id;
		echo $row;
		$delete_sql = "DELETE FROM `order` WHERE order_id=$row";
		mysql_query($delete_sql);
		exit();
	}
?>