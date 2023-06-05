<?php
    $conn = mysqli_connect('localhost', 'root', '', 'hotel');

    $reservation = "SELECT * FROM reservations ORDER BY id_res DESC LIMIT 1";
    $result = mysqli_query($conn, $reservation);
    $row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css" integrity="sha384-5QFXyVb+lrCzdN228VS3HmzpiE7ZVwLQtkt+0d9W43LQMzz4HBnnqvVxKg6O+04d" crossorigin="anonymous">
    <title>Płatność</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h2 class="text-center my-4">Opłać rezerwację</h2>
				<div class="alert alert-dismissible alert-success">
  				<strong>Kwota do zapłaty: </strong> <?php echo $row['totalPrice']; ?> zł
				</div>
				<div class="card my-4">
					<div class="card-body">
						<form>
							<div class="form-group">
								<label for="cardName">Imię i nazwisko</label>
								<input type="text" class="form-control" id="name" name="name">
							</div>
							<div class="form-group">
								<label for="card">Numer karty kredytowej</label>
								<input type="text" maxlength="16" minlength="16" class="form-control" id="card" name="card">
							</div>
							<div class="form-group">
								<label for="pin">PIN</label>
								<input type="password" maxlength="4" minlength="4" class="form-control">
							</div>
							<a href="index.html" class="btn btn-primary" onclick="alert('Pomyślnie opłacono!')">Zapłać</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<footer class="py-3 bg-light">
		<div style="text-align:center">
			<p>© 2023 SłopHotel. Wszystkie prawa zastrzeżone.</p>
		</div>
	</footer>
</body>
</html>