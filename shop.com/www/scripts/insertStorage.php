<?php 
	require 'connect.php';

	$name = $_REQUEST['productName'];
	$products_id = $_REQUEST['products'];
	$count = $_REQUEST['countProducts'];
	$arrayProductsId='';
	
	for($i=0;$i<count($products_id)-1;$i++) {
		$arrayProductsId .= $products_id[$i].', ';
	}
	$arrayProductsId .= $products_id[count($products_id)-1];

	$insert_sql = "INSERT INTO storage (name, array_products_id, array_products_count)" .
	"VALUES('{$name}', '{$arrayProductsId}', '{$count}');";
	mysql_query($insert_sql);
	
	header('location: http://shop.com/index.html');
	exit();    // прерываем работу скрипта, чтобы забыл о прошлом*/
	/*echo $name.'<br>';
	echo $products_id[1].'<br>';
	echo $count;*/
?>