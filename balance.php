<?php
	
	session_start();

	if (!isset($_SESSION['is_user_logged']) || (!$_SESSION['is_user_logged'] == true))
	{
		header('Location: index.php');
		exit();
	}
	
	$begin_date = new DateTime();
	$end_date = new DateTime();
	
	if (isset($_POST['current']))
	{
		$GLOBALS['begin_date']->modify('first day of this month');
		$GLOBALS['end_date']->modify('last day of this month');
		unset($_POST['current']);
	}
	
	if (isset($_POST['previous']))
	{
		$GLOBALS['begin_date']->modify('first day of previous month');
		$GLOBALS['end_date']->modify('last day of previous month');
		unset($_POST['previous']);
	}

	if (isset($_POST['begin_date']) && isset($_POST['end_date']))
	{
		$GLOBALS['begin_date'] = date_create_from_format('Y-m-d', $_POST['begin_date']);
		$GLOBALS['end_date'] = date_create_from_format('Y-m-d', $_POST['end_date']);
		unset($_POST['begin_date']);
		unset($_POST['end_date']);
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
	<link rel="stylesheet" href="css/fontello.css" type="text/css">
	<link rel="stylesheet" href="style.css" type="text/css">
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		
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
								
								<li class="nav-item">
									<a class="nav-link" href="expense.php"><i class="icon-basket"></i> Dodaj wydatek </a>
								</li>
								
								<li class="nav-item dropdown active">
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
												<input type="date" class="mb-3 rounded" name="begin_date">
											</div>
											
											<div class="col-sm-6">
												<h6 class="h6 text-dark">Podaj datę końcową</h6>
												<input type="date" class="mb-2 rounded" name="end_date">
											</div>
										
									</div>
								</div>
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">Zastosuj</button>
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Porzuć pomysł</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<article>
					<h1 class="h4 mt-4 mb-3 font-weight-bold text-center">Sprawdź bilans w wybranym okresie czasu</h1>
					
					<div class="row mx-2">
						
						<div class="col-12 p-3 rounded" style="border: 2px #f2f2f2 dashed">
							<div class="row">
								<div class="col mt-2 mb-4">
									<label class="sr-only">Data początkowa</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-3">Początek</span>
											</div>
											<input type="date" class="form-control" id="daterBegin" value="<?php echo $begin_date->format('Y-m-d'); ?>">
										</div>
								</div>
								
								<div class="col mt-2 mb-4">
									<label class="sr-only">Data końcowa</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-3">Koniec</span>
											</div>
											<input type="date" class="form-control" id="daterEnd" value="<?php echo $end_date->format('Y-m-d'); ?>">
										</div>
								</div>
							</div>
<?php

	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	$chart_data = Array();
	
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
			$begin = $begin_date->format('Y-m-d');
			$end = $end_date->format('Y-m-d');
			
			// balance = incomes - expenses
			$result_income_amount = $db_connection->query("SELECT SUM(amount) AS summary FROM incomes WHERE user_id = '$id' AND date_of_income BETWEEN '$begin' AND '$end'");
			
			$result_expense_amount = $db_connection->query("SELECT SUM(amount) AS summary FROM expenses WHERE user_id = '$id' AND date_of_expense BETWEEN '$begin' AND '$end'");
			
			$result_incomes = $db_connection->query("SELECT cat.name AS inc_name, SUM(inc.amount) AS inc_amount FROM incomes AS inc, incomes_category_assigned_to_users AS cat WHERE inc.user_id = '$id' AND cat.user_id = '$id' AND inc.income_category_assigned_to_user_id = cat.id AND inc.date_of_income BETWEEN '$begin' AND '$end' GROUP BY inc_name ORDER BY inc_amount DESC");
			
			$result_expenses = $db_connection->query("SELECT cat.name AS ex_name, SUM(ex.amount) AS ex_amount FROM expenses AS ex, expenses_category_assigned_to_users AS cat WHERE ex.user_id = '$id' AND cat.user_id = '$id' AND ex.expense_category_assigned_to_user_id = cat.id AND ex.date_of_expense BETWEEN '$begin' AND '$end' GROUP BY ex_name ORDER BY ex_amount DESC");
			
			if (!$result_income_amount || !$result_expense_amount || !$result_incomes || !$result_expenses)
				throw new Exception($db_connection->error);
			
			if (($result_income_amount->num_rows >= 0) && ($result_expense_amount->num_rows >= 0)
				&& ($result_incomes->num_rows >= 0) && ($result_expenses->num_rows >= 0))
			{
				$income_amount = $result_income_amount->fetch_assoc();
				$income_total = $income_amount['summary'];
				if (is_null($income_total))
					$income_total = 0;
				
				$expense_amount = $result_expense_amount->fetch_assoc();
				$expense_total = $expense_amount['summary'];
				if (is_null($expense_total))
					$expense_total = 0;
				
				$difference = $income_amount['summary'] - $expense_amount['summary'];
				
				$balance_info = "badge badge-success";
				$balance_comment = "Dobrze zarządzasz! ";
				if ($difference < 0)
				{
					$balance_info = "badge badge-warning";
					$balance_comment = "Nie wygląda to dobrze... ";
				}
					
echo<<<END

							<div class="row mb-4">
								<div class="col text-center">
									<h2 class="h4 d-inline-block"><span class="" id="comment">$balance_comment Masz teraz na koncie:</span></h2>
									<h2 class="h2 d-inline-block"><span class="$balance_info" id="balance">$difference zł</span></h2>
								</div>
							</div>
							
							<div class="row mb-2">
								<div class="col text-left">
									<h2 class="h5 d-inline-block my-1">Twoje <span class="font-weight-bold h4">przychody</span> w wybranym okreise:</h2>
									<h2 class="h3 d-inline-block my-1"><span class="badge badge-info" id="incomeSummary">$income_total zł</span></h2>
								</div>
							</div>
							
							<div class="row">
								<div class="col">
									<table class="table table-striped table-dark table-hover table-sm text-light">
										<thead>
											<tr>
												<th scope="col">Kategoria</th>
												<th scope="col">Kwota</th>
											</tr>
										</thead>
										<tbody>
END;

				while($income_row = $result_incomes->fetch_assoc())
				{
						echo '<tr><td>'.$income_row['inc_name'].'</td><td>'.$income_row['inc_amount'].'</td></tr>';
				}

echo<<<END
										</tbody>
									</table>
								</div>
							</div>

							<div class="row mb-2 mt-3">
								<div class="col text-left">
									<h2 class="h5 d-inline-block my-1">Twoje <span class="font-weight-bold h4">wydatki</span> w wybranym okreise:</h2>
									<h2 class="h3 d-inline-block my-1"><span class="badge badge-info" id="expanseSummary">$expense_total zł</span></h2>
								</div>
							</div>
							
							<div class="row">
								<div class="col">
									<table class="table table-striped table-dark table-hover table-sm text-light">
										<thead>
											<tr>
												<th scope="col">Kategoria</th>
												<th scope="col">Kwota</th>
											</tr>
										</thead>
										<tbody>
END;
				$i = 0;
				while($expense_row = $result_expenses->fetch_assoc())
				{
					echo '<tr><td>'.$expense_row['ex_name'].'</td><td>'.$expense_row['ex_amount'].'</td></tr>';
					
					$chart_data[$i] = $expense_row['ex_name'];
					$i++;
					$chart_data[$i] = $expense_row['ex_amount'];
					$i++;
				}
				
echo<<<END

										</tbody>
									</table>
								</div>
							</div>
							
END;
				
				$result_income_amount->free();
				$result_expense_amount->free();
				$result_incomes->free();
				$result_expenses->free();
			}
			else
			{
				throw new Exception("Brak rezultatu<br>");
			}
		}
		
		$db_connection->close();
	}
	catch(Exception $e)
	{
		echo 'Błąd serwera. Przepraszamy za niedogodności. Spróbuj ponownie później.<br>';
		echo 'Dev Info: '.$e;
	}
print_r($chart_data);
?>
					
							
						</div>
						
					</div>
					
					<canvas id="myChart"></canvas>
					
					<script>
						var context = document.getElementById('myChart').getContext('2d');
						var chart = new Chart(context, {
							// The type of chart we want to create
							type: 'doughnut',

							// The data for our dataset
							data: {
								labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
								datasets: [{
									label: 'My First dataset',
									backgroundColor: 'rgb(255, 99, 132)',
									borderColor: 'rgb(255, 99, 132)',
									data: [0, 10, 5, 2, 20, 30, 45]
								}]
							},

							// Configuration options go here
							options: {}
						});
					</script>
					
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