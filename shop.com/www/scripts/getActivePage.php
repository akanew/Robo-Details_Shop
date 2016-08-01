<?php 
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		
		$sql_select = "SELECT * FROM active_page WHERE active_key='1'";
		$result = mysql_query($sql_select);
		$row = mysql_fetch_array($result);

		if($row) {
			$res=$row['page_id'];
		}
		else {$res="Data error";}
		
		echo json_encode($res);
		exit();
	}
?>