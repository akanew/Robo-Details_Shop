<?php
	require 'connect.php';

	if($_POST['param'])	{
		$param = json_decode($_POST['param']);
		$login=$param->login;
		$password=$param->password;

		$login_flag=false;
		$password_flag=false;
		
		if($login && $password) {
			$sql_select = "SELECT * FROM autorisation";
			$result = mysql_query($sql_select);
			while($row = mysql_fetch_array($result)) {
				if(iconv( 'UTF-8','windows-1251', $login)==$row['login']) $login_flag=true;
				if(iconv( 'UTF-8','windows-1251', $password)==$row['password']) $password_flag=true;
			}
			
			$status=1;
			$none_status=0;
			$login_n=iconv( 'UTF-8','windows-1251', $login);
			
			if($login_flag==true && $password_flag==true) {
				$update_sql = "UPDATE autorisation SET status='$status' WHERE login='$login_n'";
				mysql_query($update_sql);
			}
			else {
				$update_sql = "UPDATE autorisation SET status='$none_status' WHERE login='$login_n'";
				mysql_query($update_sql);
			}
			
			$sql_select = "SELECT * FROM autorisation WHERE login='$login_n'";
			$result = mysql_query($sql_select);
			if($row = mysql_fetch_array($result))$res=$row['status'];
		}
		
		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>