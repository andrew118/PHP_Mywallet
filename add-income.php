<?php

	session_start();
	
	if (!isset($_SESSION['is_user_logged']) || (!$_SESSION['is_user_logged'] == true))
	{
		header('Location: index.php');
		exit();
	}

	$_SESSION['in_money'] = $_POST['money'];
	$_SESSION['in_dater'] = $_POST['dater'];
	$_SESSION['in_category'] = $_POST['category'];
	$_SESSION['in_comment'] = $_POST['comment'];
	
	$form_valid = true;
	
	if ($_POST['money'] <= 0)
	{
		$_SESSION['e_money'] = '<div class="alert alert-danger col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" role="alert">Niepoprawna kwota. Poprawny format to np. 123,45</div>';
		
		$form_valid = false;
		header('Location: income.php');
	}
	
	$separated_date = explode("-", $_POST['dater']);
	if (!checkdate($separated_date[1], $separated_date[2], $separated_date[0])) //format M-D-Y
	{
		$_SESSION['e_date'] = '<div class="alert alert-danger col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" role="alert">Niepoprawna data</div>';
		
		$form_valid = false;
		header('Location: income.php');
	}
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	if ($form_valid == true)
	{
		try
		{
			$db_connection = new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($db_connection->connect_errno != 0)
			{
				throw new Exception(mysqli_connect_errno);
			}
			else
			{
				$user_id = $_SESSION['logged_user_id'];
				$user_money = $_POST['money'];
				$user_date = $_POST['dater'];
				$user_category = $_POST['category'];
				$user_comment = $_POST['comment'];
				
				$user_comment = htmlentities($user_comment, ENT_QUOTES, "UTF-8");
				
				if ($db_connection->query(
					sprintf("INSERT INTO incomes VALUES (NULL, '$user_id', '$user_category', '$user_money', '$user_date', '%s')",
					mysqli_real_escape_string($db_connection, $user_comment))))
				{
					
					$_SESSION['income_succed'] = '<div class="alert alert-success col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" role="alert">Pomyślnie dodano przychód</div>';
					
					unset($_SESSION['in_money']);
					unset($_SESSION['in_dater']);
					unset($_SESSION['in_category']);
					unset($_SESSION['in_comment']);
					
					header('Location: income.php');
				}
				else
				{
					throw new Exception($db_connection->error);
				}
			}
			
			$db_connection->close();
		}
		catch(Exception $e)
		{
			echo 'Błąd serwera. Przepraszamy za niedogodności. Spróbuj ponownie później.';
			echo 'Dev Info: '.$e;
		}
	}

?>