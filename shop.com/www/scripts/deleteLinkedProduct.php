<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		echo $id;
		
		$sql_select = "SELECT * FROM products_group WHERE products_group_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);
		
		$array_products_id=$row['array_products_id'];
		$productId = explode(', ', $array_products_id);
		$count=count($productId);
			for($i=0;$i<$count;$i++) {
				$delete_sql = "DELETE FROM product WHERE product_id=$productId[$i]";
			}
		mysql_query($delete_sql);

		exit();
	}
///////////////////////////////////////////////////////////////////////////////////////////
//Если в других группах продуктов содержатся продукты одинаковые с удаляемым, то их значения очищаются и из соседних групп товаров, поскольку товар удалеятся. Код ниже должен исправить эту ситуацию, но он почему-то не работает =( Если его подправить, то можно исправить этот баг
/*
<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$id=$param->id;
		echo $id;
		$arr_id=array();
		$total_arr_id=array();
		$arr_index=0;
		$total_arr_index=0;
		
		$sql_select = "SELECT * FROM products_group WHERE products_group_id=$id";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);
		
		$array_products_id=$row['array_products_id'];
		$productId = explode(', ', $array_products_id);
		$count=count($productId);
		
		$sql_select_product_group = "SELECT * FROM products_group";
		$result_product_group = mysql_query($sql_select_product_group);
		while($row_product_group = mysql_fetch_array($result_product_group)) {
			if($row_product_group['products_group_id']!=$id) {
				$tmp_array_products_id=$row_product_group['array_products_id'];
				$tmp_productId = explode(', ', $tmp_array_products_id);
				$tmp_count=count($tmp_productId);
				for($i=0;$i<$tmp_count;$i++) {
					for($j=0;$j<$count;$j++) {
						if($tmp_productId[$i]==$productId[$j]) {
							$arr_id[$arr_index]=$productId[$j];
							$arr_index++;
						}
					}
				}
			}
		}
		
		if($total_arr_index==0) {
		
			$total_arr_id[$total_arr_index]=$arr_id[$total_arr_index];
			$total_arr_index++;
		}
		else {
			$flag=false;
			for($i=0;$i<$arr_index;$i++) {
				for($j=0;$j<$total_arr_index;$j++) {
					if($arr_id[$i]==$total_arr_id[$j])$flag=true;
				}
				if($flag==false){
					$total_arr_id[$total_arr_index]=$arr_id[$i];
					$total_arr_index++;
				}
			}
		}
		
		for($i=0;$i<$total_arr_index;$i++) {
			$delete_sql = "DELETE FROM product WHERE product_id=$total_arr_id[$i]";
		}
		mysql_query($delete_sql);

		exit();
	}
?>
*/
?>
		