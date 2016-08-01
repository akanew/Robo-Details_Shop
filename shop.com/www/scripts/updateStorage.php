<?php 
	require 'connect.php';

	$id = $_REQUEST['id'];
	$storageName = $_REQUEST['storage'];
	$products_id = $_REQUEST['products'];
	$arrayProductsCount = $_REQUEST['array_products_count'];
	
	$arrayProductsId='';
	
	for($i=0;$i<count($products_id)-1;$i++) {
		$arrayProductsId .= $products_id[$i].', ';
	}
	$arrayProductsId .= $products_id[count($products_id)-1];
 
	if($storageName) {
		$update_sql = "UPDATE storage SET name='$storageName' WHERE storage_id='$id'";
		mysql_query($update_sql);
	}
	if($arrayProductsId) {
		$update_sql = "UPDATE storage SET array_products_id='$arrayProductsId' WHERE storage_id='$id'";
		mysql_query($update_sql);
	}
	if($arrayProductsCount) {
		$update_sql = "UPDATE storage SET array_products_count='$arrayProductsCount' WHERE storage_id='$id'";
		mysql_query($update_sql);
	}

	header('location: http://shop.com/index.html');
	exit();
	
	/*echo $id.'</br>';
	echo $storageName.'</br>';
	echo $arrayProductsId.'</br>';
	echo $arrayProductsCount.'</br>';*/
?>