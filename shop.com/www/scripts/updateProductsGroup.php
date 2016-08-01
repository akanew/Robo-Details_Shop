<?php 
	require 'connect.php';

	$id = $_REQUEST['id'];
	$products_group_name = $_REQUEST['productsGroupName'];
	$products_id = $_REQUEST['productsGroup'];
	$arrayProductsCount = $_REQUEST['array_products_count'];
	$storage = $_REQUEST['storageToProductsGroup'];
	
	$arrayProductsId='';
	
	for($i=0;$i<count($products_id)-1;$i++) {
		$arrayProductsId .= $products_id[$i].', ';
	}
	$arrayProductsId .= $products_id[count($products_id)-1];
 
	if($products_group_name) {
		$update_sql = "UPDATE products_group SET name='$products_group_name' WHERE products_group_id='$id'";
		mysql_query($update_sql);
	}
	if($arrayProductsId) {
		$update_sql = "UPDATE products_group SET array_products_id='$arrayProductsId' WHERE products_group_id='$id'";
		mysql_query($update_sql);
	}
	if($arrayProductsCount) {
		$update_sql = "UPDATE products_group SET array_products_count='$arrayProductsCount' WHERE products_group_id='$id'";
		mysql_query($update_sql);
	}
	if($storage) {
		$update_sql = "UPDATE products_group SET storage_id='$storage' WHERE products_group_id='$id'";
		mysql_query($update_sql);
	}

	header('location: http://shop.com/index.html');
	exit();
	
	/*echo $id.'</br>';
	echo $storageName.'</br>';
	echo $arrayProductsId.'</br>';
	echo $arrayProductsCount.'</br>';*/
?>