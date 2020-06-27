<?php
	
	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$db_connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
		if ($db_connection->connect_errno != 0)
		{
			throw new Exception(mysqli_connect_errno);
		}
		else
		{
			$db_connection->set_charset("utf8");
			
			$login = $_POST['login'];
			$password = $_POST['password'];
			
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			
			if ($result = $db_connection->query(
			sprintf("SELECT id, username, password FROM users WHERE BINARY username='%s'",
			mysqli_real_escape_string($db_connection, $login))))
			{
				
				$result_count = $result->num_rows;
				
				if ($result_count > 0)
				{
					$row = $result->fetch_assoc();
					
					if (password_verify($password, $row['password']))
					{
						$_SESSION['is_user_logged'] = true;
						$_SESSION['logged_user_id'] = $row['id'];
						$_SESSION['user'] = $row['username'];
						
						unset($_SESSION['error']);
						
						$result->free();
						
						header('Location: main.php');
					}
					else
					{
						$_SESSION['error'] = '<div class="alert alert-danger col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" role="alert">Niepoprawny login lub hasło</div>';
						header('Location: index.php');
					}
				}
				else
				{
					$_SESSION['error'] = '<div class="alert alert-danger col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" role="alert">Niepoprawny login lub hasło</div>';
					header('Location: index.php');
				}
			}
			else
			{
				throw new Exception($db_connection->error);
			}
			
			$db_connection->close();
		}
	}
	catch(Exception $e)
	{
		echo 'Błąd serwera. Przepraszamy za niedogodności. Spróbuj ponownie później.';
	}
	
?>