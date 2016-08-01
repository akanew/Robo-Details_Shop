<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$productId=$param->productId;

		echo $productId;

		$delete_sql = "DELETE FROM product WHERE product_id=$productId";
		mysql_query($delete_sql);
		
		exit();
	}
?>