<?php 
	require 'connect.php';

	$name = $_REQUEST['nameProduct'];
	$productGroup = $_REQUEST['productGroup'];
	$price = $_REQUEST['price'];
	$count = $_REQUEST['count'];
	$description = $_REQUEST['description'];

	$insert_sql = "INSERT INTO product (products_group_id, name, description, price, count)" .
	"VALUES('{$productGroup}', '{$name}', '{$description}', '{$price}', '{$count}');";
	mysql_query($insert_sql);
	
	header('location: http://shop.com/index.html');
	exit();    // ��������� ������ �������, ����� ����� � �������*/
	/*echo $name;
	echo $productGroup;
	echo $price;
	echo $count;
	echo $description;*/
?>