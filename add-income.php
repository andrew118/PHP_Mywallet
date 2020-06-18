<?php

	session_start();
	
	if (!isset($_SESSION['is_user_logged']) || (!$_SESSION['is_user_logged'] == true))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	

	$_SESSION['in_money'] = $_POST['money'];
	$_SESSION['in_dater'] = $_POST['dater'];
	$_SESSION['in_category'] = $_POST['category'];
	$_SESSION['in_comment'] = $_POST['comment'];
	
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