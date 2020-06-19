<?php
	
	session_start();

	if (!isset($_SESSION['is_user_logged']) || (!$_SESSION['is_user_logged'] == true))
	{
		header('Location: index.php');
		exit();
	}
	
	$today = date('Y-m-d');

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
		<link rel="stylesheet" href="css/fontello.css" type="text/css">
		<link rel="stylesheet" href="style.css" type="text/css">
		
    <title>MyWallet | Weź w garść swoje pieniądze już dziś</title>
		
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
							<a class="text-center text-light font-italic font-lobster letter-spacing-2 font-weight-bold mb-4 d-block text-decoration-none" href="https://www.filmweb.pl/film/Pieni%C4%85dze+to+nie+wszystko-2001-1168" title="Dowiedz się więcej na Filwebie" target="_blank"><q class="h4">Piniondze to nie fszysko, ale fszysko bez piniendzy to nic</q></a>
						</div>
					
					</div>
					
					<nav class="navbar navbar-dark navbar-expand-md rounded wallet sticky-top py-0" style="border: 1px #000 solid">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="mainmenu">
						
							<ul class="navbar-nav">
								
								<li class="nav-item">
									<a class="nav-link" href="income.php"><i class="icon-money"></i> Dodaj przychód </a>
								</li>
								
								<li class="nav-item active">
									<a class="nav-link" href="expanse.php"><i class="icon-basket"></i> Dodaj wydatek </a>
								</li>
								
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" aria-haspopup="true"><i class="icon-calendar"></i> Przeglądaj bilans </a>
									
									<div class="dropdown-menu wallet" aria-labelledby="submenu">
										
										<a class="dropdown-item" href="balance.php"> Bierzący miesiąc </a>
										<a class="dropdown-item" href="balance.php"> Poprzedni miesiąc </a>
										<button class="dropdown-item btn btn-link"  data-toggle="modal" data-target="#dateRangeModal"> Inny zakres </button>
										
									</div>
									
								</li>
								
								<li class="nav-item">
									<a class="nav-link" href="settings.php"><i class="icon-conf"></i> Ustawienia </a>
								</li>
								
								<li class="nav-item">
									<a class="nav-link" href="index.php"><i class="icon-logout"></i> Wyloguj </a>
								</li>
								
							</ul>
						
						</div>
						
					</nav>
					
				</header>
				
								<!-- MODAL STARTS HERE -->
				<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="dateRangeInput" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-dark font-weight-bold" id="dateRangeInput">Podaj zakres dat</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-6">
										<h6 class="h6 text-dark">Podaj datę początkową</h6>
										<input type="date" class="mb-3 rounded" id="beginDate">
									</div>
									
									<div class="col-sm-6">
										<h6 class="h6 text-dark">Podaj datę końcową</h6>
										<input type="date" class="mb-2 rounded" id="endDate">
									</div>
								</div>
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-success">Zastosuj</button>
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Porzuć pomysł</button>
							</div>
						</div>
					</div>
				</div>				
				
				<article>
					<h1 class="h4 mt-4 mb-3 font-weight-bold text-center">Dodaj swoje wydatki</h1>
					
					<div class="row mx-2">
						
						<div class="col-sm-10 col-md-8 col-lg-6 mx-auto p-3 rounded" style="border: 2px #f2f2f2 dashed">
							<form action="#">
															
								<div class="col">
									<label class="sr-only">Kwota</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-2">Kwota</span>
											</div>
											<input type="number" class="form-control" step="0.01" name="money" value="0.00">
										</div>
								</div>
								
								<div class="col mt-2 mb-4">
									<label class="sr-only">Data</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-3">Data</span>
											</div>
											<input type="date" class="form-control" name="dater" value="<?php echo $today; ?>">
										</div>
								</div>

<?php

	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$db_connection = new mysqli($host, $db_user, $db_password, $db_name);
		
		if ($db_connection->connect_errno !=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$id = $_SESSION['logged_user_id'];
			$result = $db_connection->query("SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id = '$id'");
			
			if (!$result)
				throw new Exception($db_connection->error);
			
			$categories_count = $result->num_rows;

			if ($categories_count > 0)
			{
				echo '<div class="col mt-2 mb-4">';
				echo '<label class="mr-sm-2" for="paymentMethod">Metoda płatności</label>';
				echo '<select class="custom-select mr-sm-2" name="paymentMethod">';
				
				while($user_categories = $result->fetch_assoc())
				{
					echo "<option value=".$user_categories['id'].">".$user_categories['name']."</option>";
				}
				echo '</select>';
				
				$result->free();
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

?>
										
								</div>
																
								<div class="col mt-2 mb-4">
									<label class="mr-sm-2" for="categotyExpanse">Kategoria</label>
									<select class="custom-select mr-sm-2" name="categotyExpanse">
										<option value="0">Jedzenie</option>
										<option value="1">Mieszkanie</option>
										<option value="2">Transport</option>
										<option value="3">Telekomunikacja</option>
										<option value="4">Ochrona zdrowia</option>
										<option value="5">Odzież</option>
										<option value="6">Higiena</option>
										<option value="7">Dzieci</option>
										<option value="8">Rozrywka</option>
										<option value="9">Wycieczka</option>
										<option value="10">Szkolenia</option>
										<option value="11">Książki</option>
										<option value="12">Oszczędności</option>
										<option value="13">Emerytura</option>
										<option value="14">Spłata długów</option>
										<option value="15">Darowizna</option>
										<option value="15">Inne</option>
									</select>
									
								
									<div class="form-group mt-2 mb-4">
										<label for="comment" class="sr-only">Komentarz</label>
										<input type="text" class="form-control" name="comment" placeholder="Komentarz (opcjonalnie)" aria-describedby="commentHelp">
										<small id="commentHelp" class="form-text text-warning text-right">Dodatkowy opis, np. weekend w górach, obiad na mieście itp.</small>
									</div>
								</div>
								
								<input type="button" class="btn btn-lg btn-block btn-success mb-4" value="Dodaj">
								<a href="main.php" class="btn btn-sm btn-block btn-outline-danger">Anuluj</a>

							</form>
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