<?php 
	require 'connect.php';

	$name = $_REQUEST['productsGroupName'];
	$products_id = $_REQUEST['productsGroup'];
	$count = $_REQUEST['countProductsGroup'];
	$storage = $_REQUEST['storageToProductsGroup'];
	$arrayProductsId='';
	
	for($i=0;$i<count($products_id)-1;$i++) {
		$arrayProductsId .= $products_id[$i].', ';
	}
	$arrayProductsId .= $products_id[count($products_id)-1];

	$insert_sql = "INSERT INTO products_group (name, array_products_id, array_products_count, storage_id)" .
	"VALUES('{$name}', '{$arrayProductsId}', '{$count}', '{$storage}');";
	mysql_query($insert_sql);
	
	header('location: http://shop.com/index.html');
	exit();    // прерываем работу скрипта, чтобы забыл о прошлом*/
	/*echo $name.'<br>';
	echo $products_id[1].'<br>';
	echo $count;*/
?>