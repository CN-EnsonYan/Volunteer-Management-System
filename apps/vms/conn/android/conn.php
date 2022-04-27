<?php
	$dbhost = "localhost:3306";
	$dbuser="credit";
	$dbpass="your_password_here";
	$dbname="credit";
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die("Connect error ! / 连接错误");
	@mysql_select_db($dbname) or die("Database error ! / 数据库错误");
	mysql_query("set names 'UTF-8'");
?>