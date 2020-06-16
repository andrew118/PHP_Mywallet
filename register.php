<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		$form_valid = true;
		
		
		$login = $_POST['login'];
		if ((strlen($login) < 3) || strlen($login) > 20)
		{
			$form_valid = false;
			$_SESSION['e_login'] = "Login musi posiadać od 3 do 20 znaków";
		}
		
		if (ctype_alnum($login) == false)
		{
			$form_valid = false;
			$_SESSION['e_login'] = "Login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		
		$email = $_POST['email'];
		$email_sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
		if ((filter_var($email_sanitized, FILTER_VALIDATE_EMAIL) == false) || ($email_sanitized != $email))
		{
			$form_valid = false;
			$_SESSION['e_email'] = "Podaj poprawny adres e-mail";
		}
		
		
		$password = $_POST['password'];
		$password_compare = $_POST['passCompare'];
		if ((strlen($password) < 8) || (strlen($password) > 30))
		{
			$form_valid = false;
			$_SESSION['e_password'] = "Niepoprawne hasło - od 8 do 30 znaków";
		}
		
		if ($password != $password_compare)
		{
			$form_valid = false;
			$_SESSION['e_password'] = "Podane hasła nie są identyczne";
		}
		
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		
		
		if ($form_valid == true)
		{
			// insert into BD
			echo "Formularz poprawny";
			exit();
		}
	}

?>

<!DOCTYPE html>
<html lang="pl">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Aplikacja do prowadzenia budżetu osobistego lub domowego. Pieniądze pod kontrolą.">
		<meta name="keywords" content="pieniądze, budżet, wydatki, kontrola, kasa, oszczędzanie, portfel on-line">
		<meta http-equiv="X-Ua-Compatible" content="IE=edge">
	
		<link href="https://fonts.googleapis.com/css?family=Dosis:400,700%7CLobster&display=swap&subset=latin-ext" rel="stylesheet">
																<!-- %7C == | which is not valid with html standard -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css" type="text/css" />
		
    <title>MyWallet | Załóż darmowe konto | Weź w garść swoje pieniądze już dziś</title>
		
  </head>
	
  <body>
    <main>
			<div class="container mb-5">
				
				<header>
					
					<div class="row">
						<div class="col-12">
							<h1 class="h1 font-italic text-center font-lobster letter-spacing-4 font-weight-bold mt-4 mb-1">$ MyWallet $</h1>
						</div>
						
						<div class="col-12">
							<a class="text-center text-light font-italic font-lobster letter-spacing-2 font-weight-bold mb-5 d-block text-decoration-none" href="https://www.filmweb.pl/film/Pieni%C4%85dze+to+nie+wszystko-2001-1168" title="Dowiedz się więcej na Filwebie" target="_blank"><q class="h4">Piniondze to nie fszysko, ale fszysko bez piniendzy to nic</q></a>
						</div>
					
					</div>
				</header>
							
				<?php
				
				$alert1 = '<div id="info" class="alert alert-danger col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" role="alert">';
				$alert2 = '</div>';
				
				if (isset($_SESSION['e_login']))
				{
					echo $alert1.$_SESSION['e_login'].$alert2;
					unset($_SESSION['e_login']);
				}
				
				if (isset($_SESSION['e_email']))
				{
					echo $alert1.$_SESSION['e_email'].$alert2;
					unset($_SESSION['e_email']);
				}
				
				if (isset($_SESSION['e_password']))
				{
					echo $alert1.$_SESSION['e_password'].$alert2;
					unset($_SESSION['e_password']);
				}
				
				?>

<!--						
				<div id="infoOk" class="alert alert-success col-10 col-sm-8 col-md-6 col-lg-4 mx-auto text-center" style="display: none;" role="alert">
					OK. Możesz się teraz zalogować.
				</div>
-->				
				<section>
					
					<div class="row">
						<div class="col-10 col-sm-8 col-md-6 col-lg-4 mx-auto rounded" style="border: 1px #f2f2f2 dashed; background-color: rgba(242, 242, 242, 0.2); ">
							
							<form method="post">
								
								<div class="col-10 offset-1">
									<input type="text" class="form-control mt-5 mb-3" placeholder="Podaj login" name="login">
								</div>
								
								<div class="col-10 offset-1">
									<input type="password" class="form-control mb-3" placeholder="Podaj hasło" name="password">
								</div>
								
								<div class="col-10 offset-1">
									<input type="password" class="form-control mb-3" id="passwordCompare" placeholder="Powtórz hasło" name="passCompare">
								</div>
								
								<div class="col-10 offset-1">
									<input type="text" class="form-control mb-4" id="email" placeholder="Podaj e-mail" name="email">
								</div>
								
								<div class="col-10 offset-1">
									<input type="submit" class="btn btn-info btn-block mb-5 font-weight-bold" value="Zarejestruj się">
								</div>
								
							</form>
							
						</div>
					</div>
					
				</section>
				
				
				<article>
				
					<div class="row mt-4">
						<h1 class="h4 col-12 text-center mb-4">Życie zmienia smak, gdy <strong>Twoje finanse</strong> znajdują się <strong>pod Twoją kontrolą</strong></h1>
					
						<div class="col-12 text-center">
							<ul class="list-unstyled">
								<li class="mb-1">Bilans z całego miesiąca lub wybranego okresu</li>
								<li class="mb-1">Wydatki posegregowane według kategorii</li>
								<li class="mb-1">Wizualizacja obszarów Twoich wydatków</li>
							</ul>
						</div>
					</div>
					
				</article>
				
				<footer class="fixed-bottom text-center bg-dark text-white-50" style="border-top: 1px #f2f2f2 dashed">
					Created by &copy; ANDREW
				</footer>
				
			</div>
		</main>
		
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		
  </body>
</html>