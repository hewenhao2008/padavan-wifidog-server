<?php
	session_start();
	include("../conn.php");
	$token = $_GET['token'];
	$sql="select * from users where usertoken='{$token}'";
	$res=mysqli_query($conn,$sql);
	// echo $sql;
	// $row=mysql_fetch_array($res);
	// print_r($row);
	if (mysqli_num_rows($res)>0) {
		echo ("Auth: 1\n");
		echo ("Messages: Allow Access\n");
		exit;
	}
	else
	{
		echo ("Auth: 0\n");
		echo ("Messages: No Access\n");
		exit;
	}
?>