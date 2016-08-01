<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		echo $id;

		$delete_sql = "DELETE FROM `cart` WHERE cart_id=$id";
		mysql_query($delete_sql);
		exit();
	}
?>