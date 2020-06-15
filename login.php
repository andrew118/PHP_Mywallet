<?php

	require_once "connect.php";
	
	$db_connection = new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($db_connection->connect_errno != 0)
	{
		echo "Błąd: ".$db_connection->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		echo $login.' '.$password;
		
		
		
		$db_connection->close();
	}

	
	
?>