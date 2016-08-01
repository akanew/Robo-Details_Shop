<?php 
	require 'connect.php';

	$id = $_REQUEST['id'];
	$orderForStorageName = $_REQUEST['orderForStorageName'];
	$products_id = $_REQUEST['products'];
	$arrayProductsCount = $_REQUEST['array_products_count'];	
	$orderDate = $_REQUEST['orderDate'];
	$agent = $_REQUEST['agent'];
	
	$arrayProductsId='';
	
	for($i=0;$i<count($products_id)-1;$i++) {
		$arrayProductsId .= $products_id[$i].', ';
	}
	$arrayProductsId .= $products_id[count($products_id)-1];
 
	if($orderForStorageName) {
		$update_sql = "UPDATE order_for_storage SET storage_id='$orderForStorageName' WHERE order_for_storage_id='$id'";
		mysql_query($update_sql);
	}
	if($arrayProductsId) {
		$update_sql = "UPDATE order_for_storage SET array_products_id='$arrayProductsId' WHERE order_for_storage_id='$id'";
		mysql_query($update_sql);
	}
	if($arrayProductsCount) {
		$update_sql = "UPDATE order_for_storage SET array_products_count='$arrayProductsCount' WHERE order_for_storage_id='$id'";
		mysql_query($update_sql);
	}
	if($orderDate) {
		$update_sql = "UPDATE order_for_storage SET order_date='$orderDate' WHERE order_for_storage_id='$id'";
		mysql_query($update_sql);
	}
	if($agent) {
		$update_sql = "UPDATE order_for_storage SET agent='$agent' WHERE order_for_storage_id='$id'";
		mysql_query($update_sql);
	}

	header('location: http://shop.com/index.html');
	exit();
	
	/*echo $id.'</br>';
	echo $storageName.'</br>';
	echo $arrayProductsId.'</br>';
	echo $arrayProductsCount.'</br>';*/
?>