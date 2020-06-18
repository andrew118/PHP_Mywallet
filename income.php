<?php
	
	session_start();

	if (!isset($_SESSION['is_user_logged']) || (!$_SESSION['is_user_logged'] == true))
	{
		header('Location: index.php');
		exit();
	}
	
	$today = date('Y-m-d');
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);

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
								
								<li class="nav-item active">
									<a class="nav-link" href="income.php"><i class="icon-money"></i> Dodaj przychód </a>
								</li>
								
								<li class="nav-item">
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
					<h1 class="h4 mt-4 mb-3 font-weight-bold text-center">Dodaj swoje przychody</h1>
					
					<?php
					
					if (isset($_SESSION['e_money']))
					{	
						echo $_SESSION['e_money'];
						unset($_SESSION['register_succed']);
					}
					else if (isset($_SESSION['e_date']))
					{
						echo $_SESSION['e_date'];
						unset($_SESSION['e_date']);
					}
					
					?>
					
					<div class="row mx-2">
						
						<div class="col-sm-10 col-md-8 col-lg-6 mx-auto p-3 rounded" style="border: 2px #f2f2f2 dashed">
							<form action="add-income.php" method="post">
															
								<div class="col">
									<label class="sr-only">Kwota</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-2">Kwota</span>
											</div>
											<input type="number" class="form-control" step="0.01" name="money" value="<?php
											if (isset($_SESSION['in_money']))
											{
												echo $_SESSION['in_money'];
												unset($_SESSION['in_money']);
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
											if (isset($_SESSION['in_dater']))
											{
												echo $_SESSION['in_dater'];
												unset($_SESSION['in_dater']);
											}
											else	
												echo $today; ?>">
										</div>
								</div>
																
								<div class="col mt-2 mb-4">
									<label class="mr-sm-2" for="categoty">Kategoria</label>
									<select class="custom-select mr-sm-2" name="category" value="<?php
											if (isset($_SESSION['in_category']))
											{
												echo $_SESSION['in_category'];
												unset($_SESSION['in_category']);
											}
											?>">
<?php
	
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
			$result = $db_connection->query("SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id = '$id'");
			
			if (!$result)
				throw new Exception($db_connection->error);
			
			$categories_count = $result->num_rows;
			$_SESSION['categories_count'] = $categories_count;
			if ($categories_count > 0)
			{
				while($user_categories = $result->fetch_assoc())
				{
					echo "<option value=".$user_categories['id'].">".$user_categories['name']."</option>";
				}
				$result->free_result();
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
									</select>
									
								
									<div class="form-group mt-2 mb-4">
										<label for="comment" class="sr-only">Komentarz</label>
										<input type="text" class="form-control" name="comment" placeholder="Komentarz (opcjonalnie)" value="<?php
											if (isset($_SESSION['in_comment']))
											{
												echo $_SESSION['in_comment'];
												unset($_SESSION['in_comment']);
											}
											?>" aria-describedby="commentHelp">
										<small id="commentHelp" class="form-text text-warning text-right">Dodatkowy opis, np. sprzedany rower, dywidendy itp.</small>
									</div>
								</div>
								
								<input type="submit" class="btn btn-lg btn-block btn-success mb-4" value="Dodaj">
								<input type="button" class="btn btn-sm btn-block btn-outline-danger" value="Anuluj">

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