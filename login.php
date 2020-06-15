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
				
				$_SESSION['is_user_logged'] = true;
				$_SESSION['logged_user_id'] = $row['id'];
				$_SESSION['user'] = $row['username'];
				
				unset($_SESSION['error']);
				
				$result->free();
				
				header('Location: main.php');
			}
			else
			{
				$_SESSION['error'] = '<div class="alert alert-danger col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" role="alert">Niepoprawne dane!</div>';
				header('Location: index.php');
			}
		}
		
		$db_connection->close();
	}

	
	
?>