<?php

	session_start();
	require_once "connect.php";
	
/*
	echo $_POST['money'].'<br>';
	echo $_POST['dater'].'<br>';
	echo $_POST['category'].'<br>';
	echo $_POST['comment'].'<br>';
*/
	$form_valid = true;
	
	if ($_POST['money'] <= 0)
	{
		$_SESSION['e_money'] = "Niepoprawna kwota";
		$form_valid = false;
		header('Location: income.php');
	}
	
	$separated_date = explode("-", $_POST['dater']);
	if (!checkdate($separated_date[1], $separated_date[2], $separated_date[0])) //format M-D-Y
	{
		$_SESSION['e_date'] = "Niepoprawna data";
		$form_valid = false;
		header('Location: income.php');
	}
	
	//strlen($_POST['comment']);

?>