<?php 
	require 'connect.php';

	if($_POST['searchData'])	{
		$searchData = json_decode($_POST['searchData']);
		
		$fio = $searchData->fio;
		$phone_number = $searchData->phone_number;
		$mail_address = $searchData->mail_address;
		$address = $searchData->address;
		$card_number = $searchData->card_number;

		$sql_select = "SELECT * FROM user_data";
		$result = mysql_query($sql_select);
		//Массив id
		$arr=array();
		//Массивы совпадений
		$arr_fio=array();
		$arr_phone_number=array();
		$arr_mail_address=array();
		$arr_address=array();
		$arr_card_number=array();
		//Массив индексов найденных записей
		$id=array();
		$recordsFound=0;
		$cycle=0;
		$countCell=0;
		$countMatches=0;
		$found=0;
		
		$active_fio=false;
		$active_phone_number=false;
		$active_mail_address=false;
		$active_address=false;
		$active_card_number=false;
		
		//Определение количества и качества заполненных полей
		if($fio) {
			$active_fio=true;
			$countCell++;
		}
		if($phone_number) {
			$active_phone_number=true;
			$countCell++;
		}
		if($mail_address) {
			$active_mail_address=true;
			$countCell++;
		}
		if($address) {
			$active_address=true;
			$countCell++;
		}
		if($card_number) {
			$active_card_number=true;
			$countCell++;
		}
	 
		//Заполнение массивов совпадений
		while ($row = mysql_fetch_array($result)){
			$arr[$cycle]=$row['user_id'];
			
			if($active_fio && iconv( 'UTF-8','windows-1251', $fio)==$row['fio']) $arr_fio[$cycle]=1;
			else $arr_fio[$cycle]=0;
			
			if($active_phone_number && iconv( 'UTF-8','windows-1251', $phone_number)==$row['phone_number']) $arr_phone_number[$cycle]=1;
			else $arr_phone_number[$cycle]=0;
			
			if($active_mail_address && iconv( 'UTF-8','windows-1251', $mail_address)==$row['mail_address']) $arr_mail_address[$cycle]=1;
			else $arr_mail_address[$cycle]=0;
			
			if($active_address && iconv( 'UTF-8','windows-1251', $address)==$row['address']) $arr_address[$cycle]=1;
			else $arr_address[$cycle]=0;
			
			if($active_card_number && iconv( 'UTF-8','windows-1251', $card_number)==$row['card_number']) $arr_card_number[$cycle]=1;
			else $arr_card_number[$cycle]=0;
			
			$cycle++;
		}
		
		//Определение индексов искомых записей
		for ($i=0; $i<$cycle; $i++){
			$countMatches=0;
			if($active_fio && $arr_fio[$i]==1) $countMatches++;
			if($active_phone_number && $arr_phone_number[$i]==1) $countMatches++;
			if($active_mail_address && $arr_mail_address[$i]==1) $countMatches++;
			if($active_address && $arr_address[$i]==1) $countMatches++;
			if($active_card_number && $arr_card_number[$i]==1) $countMatches++;
			if($countCell==$countMatches) {
				$id[$recordsFound]=$arr[$i];
				$recordsFound++;			
			}
		}
		
		/*for ($i=0; $i<$recordsFound; $i++){
			$res.=$id[$i]."|";
		}*/
		
		//Определение данных искомых записей
		
		
		for ($i=0; $i<$recordsFound; $i++){
		
			$sql_select = "SELECT * FROM user_data";
			$result = mysql_query($sql_select);
		
			while ($row = mysql_fetch_array($result)) {
				if($id[$i]==$row['user_id']) $res.=$row['user_id']."|".$row['fio']."|".$row['phone_number']."|".$row['mail_address']."|".$row['address']."|".$row['card_number']."*";
			}
		}
		
		if(!$res) $res="Records not found!";
	 
		echo json_encode(iconv('windows-1251', 'UTF-8', $res));
		exit();
	}
?>