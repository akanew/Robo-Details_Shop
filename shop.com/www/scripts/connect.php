<?php
	mysql_connect("localhost", "anna", "12345")//��������� � ������� ("����", "��� ������������", "������")
	or die("<p>������ ����������� � ���� ������! " . mysql_error() . "</p>");

	mysql_select_db("database_store")//�������� � ������� ("��� ����, � ������� �����������")
	or die("<p>������ ������ ���� ������! ". mysql_error() . "</p>");
?>