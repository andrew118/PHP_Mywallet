<?php

	session_start();
	
	if (!isset($_SESSION['is_user_logged']) || (!$_SESSION['is_user_logged'] == true))
	{
		header('Location: index.php');
		exit();
	}

	

?>