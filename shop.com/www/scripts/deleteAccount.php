<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$accountId=$param->accountId;
		$cartId=$param->cartId;
		echo $cartId;

		$delete_sql = "DELETE FROM account WHERE account_id=$accountId";
		mysql_query($delete_sql);
		
		$delete_sql = "DELETE FROM cart WHERE cart_id=$cartId";
		mysql_query($delete_sql);
		
		exit();
	}
?>