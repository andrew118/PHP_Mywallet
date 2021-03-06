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
										<form method="post">
											<input type="submit" name="current" class="dropdown-item btn btn-link" formaction="balance.php" value=" Bierzący miesiąc ">
											<input type="submit" name="previous" class="dropdown-item btn btn-link" formaction="balance.php" value=" Poprzedni miesiąc ">
										</form>
										<button class="dropdown-item btn btn-link"  data-toggle="modal" data-target="#dateRangeModal"> Inny zakres </button>
										
									</div>
									
								</li>
								
								<li class="nav-item">
									<a class="nav-link" href="settings.php"><i class="icon-conf"></i> Ustawienia </a>
								</li>
								
								<li class="nav-item">
									<a class="nav-link" href="logout.php"><i class="icon-logout"></i> Wyloguj </a>
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
							
							<form action="balance.php" method="post">
								<div class="modal-body">
									<div class="row">
										
											<div class="col-sm-6">
												<h6 class="h6 text-dark">Podaj datę początkową</h6>
												<input type="date" class="mb-3 rounded" name="begin_date" id="begin_date">
											</div>
											
											<div class="col-sm-6">
												<h6 class="h6 text-dark">Podaj datę końcową</h6>
												<input type="date" class="mb-2 rounded" name="end_date" id="end_date">
											</div>
										
									</div>
								</div>
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-success" id="modal_submit">Zastosuj</button>
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Porzuć pomysł</button>
								</div>
							</form>
						</div>
					</div>
				</div>				
				
				<article>
					<h1 class="h4 mt-4 mb-3 font-weight-bold text-center">Dodaj swoje wydatki</h1>
					
					<?php
					
					if (isset($_SESSION['e_money']))
					{	
						echo $_SESSION['e_money'];
						unset($_SESSION['e_money']);
					}
					else if (isset($_SESSION['e_date']))
					{
						echo $_SESSION['e_date'];
						unset($_SESSION['e_date']);
					}
					else if (isset($_SESSION['expense_succed']))
					{
						echo $_SESSION['expense_succed'];
						unset($_SESSION['expense_succed']);
					}
					
					?>
					
					<div class="row mx-2">
						
						<div class="col-sm-10 col-md-8 col-lg-6 mx-auto p-3 rounded" style="border: 2px #f2f2f2 dashed">
							<form action="add-expense.php" method="post">
															
								<div class="col">
									<label class="sr-only">Kwota</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-2">Kwota</span>
											</div>
											<input type="number" class="form-control" step="0.01" name="money" min="0.00" value="<?php
											if (isset($_SESSION['ex_money']))
											{
												echo $_SESSION['ex_money'];
												unset($_SESSION['ex_money']);
											}
											else	
												echo "0.00"; ?>">
										</div>
								</div>
								
								<div class="col mt-2 mb-4">
									<label class="sr-only">Data</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-3">Data</span>
											</div>
											<input type="date" class="form-control" name="dater" value="<?php
											if (isset($_SESSION['ex_dater']))
											{
												echo $_SESSION['ex_dater'];
												unset($_SESSION['ex_dater']);
											}
											else	
												echo $today; ?>">
										</div>
								</div>
								
								<div class="col mt-2 mb-4">
								<label class="mr-sm-2" for="payment">Metoda płatności</label>
								<select class="custom-select mr-sm-2" name="payment"">
								

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
			$db_connection->set_charset("utf8");
			
			$id = $_SESSION['logged_user_id'];
			$result = $db_connection->query("SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id = '$id'");
			
			if (!$result)
				throw new Exception($db_connection->error);
			
			$categories_count = $result->num_rows;

			if ($categories_count > 0)
			{
				
				while($user_categories = $result->fetch_assoc())
				{
					if (isset($_SESSION['ex_payment']) && ($_SESSION['ex_payment'] == $user_categories['id']))
					{
						echo "<option value=".$user_categories['id']." selected>".$user_categories['name']."</option>";
						unset($_SESSION['ex_payment']);
					}
					else
						echo "<option value=".$user_categories['id'].">".$user_categories['name']."</option>";
				}
				
				
				$result->free();
			}
			else
			{
				throw new Exception($db_connection->error);
			}
?>
								
								</select></div>
								
								<div class="col mt-2 mb-4">
								<label class="mr-sm-2" for="category">Kategoria</label>
								<select class="custom-select mr-sm-2" name="category" value="<?php
									if (isset($_SESSION['ex_category']))
									{
										echo $_SESSION['ex_category'];
										unset($_SESSION['ex_category']);
									}
								?>">
								
<?php
			$result = $db_connection->query("SELECT id, name FROM expenses_category_assigned_to_users WHERE user_id = '$id'");
			
			if (!$result)
				throw new Exception($db_connection->error);
			
			$categories_count = $result->num_rows;

			if ($categories_count > 0)
			{
				while($user_categories = $result->fetch_assoc())
				{
					if (isset($_SESSION['ex_payment']) && ($_SESSION['ex_category'] == $user_categories['id']))
					{
						echo "<option value=".$user_categories['id']." selected>".$user_categories['name']."</option>";
						unset($_SESSION['ex_payment']);
					}
					else
						echo "<option value=".$user_categories['id'].">".$user_categories['name']."</option>";
				}
				
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
	}

?>		
									</select>
								
									<div class="form-group mt-2 mb-4">
										<label for="comment" class="sr-only">Komentarz</label>
										<input type="text" class="form-control" name="comment" placeholder="Komentarz (opcjonalnie)" aria-describedby="commentHelp" value="<?php
											if (isset($_SESSION['ex_comment']))
											{
												echo $_SESSION['ex_comment'];
												unset($_SESSION['ex_comment']);
											}
										
										?>">
										<small id="commentHelp" class="form-text text-warning text-right">Dodatkowy opis, np. weekend w górach, obiad na mieście itp.</small>
									</div>
								</div>
								
								<input type="submit" class="btn btn-lg btn-block btn-success mb-4" value="Dodaj">
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
		
	<script src="js/date.js"></script>
	
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		
  </body>
</html>