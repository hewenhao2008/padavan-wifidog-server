<?php
	$mysql_server_name="localhost"; 
    $mysql_username="root";
    $mysql_password="admin";
    $conn=mysqli_connect($mysql_server_name, $mysql_username,$mysql_password);
    mysqli_select_db($conn,"wifi");
?>