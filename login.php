<?php
	
	session_start();
	
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
		
		$sql = "SELECT id, username FROM users WHERE username='$login' AND password='$password'";
		
		if ($result = $db_connection->query($sql))
		{
			$result_count = $result->num_rows;
			
			if ($result_count > 0)
			{
				$row = $result->fetch_assoc();
				
				$_SESSION['logged_user_id'] = $row['id'];
				$_SESSION['user'] = $row['username'];
				
				header('Location: main.php');
				
				$result->free();
			}
			else
			{
				
			}
		}
		
		$db_connection->close();
	}

	
	
?>