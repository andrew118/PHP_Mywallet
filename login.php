<?php

	require_once "connect.php";
	
	$db_connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($db_connection->connect_errno != 0)
	{
		echo "Błąd: ".$db_connection->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM users WHERE username='$login' AND password='$password'";
		
		if ($result = $db_connection->query($sql))
		{
			$result_count = $result->num_rows;
			
			if ($result_count > 0)
			{
				$row = $result->fetch_assoc();
				
				echo '1. '.$row['id'].' 2. '.$row['username'].' 3. '.$row['password'].' 4. '.$row['email'];
				
				$result->free();
			}
			else
			{
				
			}
		}
		
		$db_connection->close();
	}

	
	
?>