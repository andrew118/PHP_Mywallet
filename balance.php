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
								
								<li class="nav-item">
									<a class="nav-link" href="expense.php"><i class="icon-basket"></i> Dodaj wydatek </a>
								</li>
								
								<li class="nav-item dropdown active">
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
											<input type="date" class="form-control" id="daterBegin" value="">
										</div>
								</div>
								
								<div class="col mt-2 mb-4">
									<label class="sr-only">Data końcowa</label>
										<div class="input-group input-group-lg">
											<div class="input-group-prepend">
												<span class="input-group-text px-3">Koniec</span>
											</div>
											<input type="date" class="form-control" id="daterEnd" value="">
										</div>
								</div>
							</div>
							
							<div class="row mb-4">
								<div class="col text-center">
									<h2 class="h4 d-inline-block"><span class="" id="comment">Dobrze zarządzasz! Masz teraz na koncie:</span></h2>
									<h2 class="h2 d-inline-block"><span class="badge badge-success" id="balance">1234,45 zł</span></h2>
								</div>
							</div>
							
							<div class="row mb-2">
								<div class="col text-left">
									<h2 class="h5 d-inline-block my-1">Twoje <span class="font-weight-bold h4">przychody</span> w wybranym okreise:</h2>
									<h2 class="h3 d-inline-block my-1"><span class="badge badge-info" id="incomeSummary">2550,56 zł</span></h2>
								</div>
							</div>
							
							<div class="row">
								<div class="col">
									<table class="table table-striped table-dark table-hover table-sm text-light">
										<thead>
											<tr>
												<th scope="col">Data</th>
												<th scope="col">Kategoria</th>
												<th scope="col">Kwota</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>10-02-2020</td>
												<td>Wyspłata</td>
												<td>2450,32</td>
											</tr>
											<tr>
												<td>02-02-2020</td>
												<td>Darowizna</td>
												<td>100,00</td>
											</tr>
											<tr>
												<td>29-02-2020</td>
												<td>Odsetki bankowe</td>
												<td>0,24</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							
							<div class="row mb-2 mt-3">
								<div class="col text-left">
									<h2 class="h5 d-inline-block my-1">Twoje <span class="font-weight-bold h4">wydatki</span> w wybranym okreise:</h2>
									<h2 class="h3 d-inline-block my-1"><span class="badge badge-warning" id="expanseSummary">550,56 zł</span></h2>
								</div>
							</div>
							
							<div class="row">
								<div class="col">
									<table class="table table-striped table-dark table-hover table-sm text-light">
										<thead>
											<tr>
												<th scope="col">Data</th>
												<th scope="col">Kategoria</th>
												<th scope="col">Kwota</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>10-02-2020</td>
												<td>Jedzenie</td>
												<td>450,32</td>
											</tr>
											<tr>
												<td>02-02-2020</td>
												<td>Dzieci</td>
												<td>44,00</td>
											</tr>
											<tr>
												<td>29-02-2020</td>
												<td>Książki</td>
												<td>6,00</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							
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