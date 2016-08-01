<?php 
	require 'connect.php';

	$id = $_REQUEST['id'];
	$name = $_REQUEST['product'];
	$products_group_id = $_REQUEST['products_group'];	
	$price = $_REQUEST['price'];
	$count = $_REQUEST['count'];
	$description = $_REQUEST['description'];
	
	if($name) {
		$update_sql = "UPDATE product SET name='$name' WHERE product_id='$id'";
		mysql_query($update_sql);
	}
	if($products_group_id) {
		$update_sql = "UPDATE product SET products_group_id='$products_group_id' WHERE product_id='$id'";
		mysql_query($update_sql);
	}
	if($price) {
		$update_sql = "UPDATE product SET price='$price' WHERE product_id='$id'";
		mysql_query($update_sql);
	}
	if($count) {
		$update_sql = "UPDATE product SET count='$count' WHERE product_id='$id'";
		mysql_query($update_sql);
	}
	if($description) {
		$update_sql = "UPDATE product SET description='$description' WHERE product_id='$id'";
		mysql_query($update_sql);
	}

	header('location: http://shop.com/index.html');
	exit();
	
	/*echo $id.'</br>';
	echo $name.'</br>';
	echo $products_group_id.'</br>';
	echo $price.'</br>';
	echo $count.'</br>';
	echo $description.'</br>';*/
?>