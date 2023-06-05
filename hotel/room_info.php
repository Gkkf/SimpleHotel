<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css" integrity="sha384-5QFXyVb+lrCzdN228VS3HmzpiE7ZVwLQtkt+0d9W43LQMzz4HBnnqvVxKg6O+04d" crossorigin="anonymous">
    <link rel="stylesheet" href="tables.css">
    <title>Informacje o pokoju</title>
</head>
<body>
    <br>
    <a id="bti" href="rooms.php" class="btn btn-secondary">Powrót</a>
    <hr>
    <br>
    <div class="container">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'hotel');
        $room_id = $_POST['id'];
        $sql = "SELECT * FROM rooms WHERE id=$room_id";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
            echo "<h1>" . "Pokój numer: " . $row["number"] . "</h1><br>";
            echo "<div class='row'>";
            echo "<div class='col-md-6'>";
            echo "<img src='" . $row["img"] . "' style='max-width:100%'>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo "<p><strong>Cena: </strong>" . $row["price"] . " zł/dzień</p>";
            echo "<p><strong>Dodatkowe wyposażenie: </strong>" . "</p>";
            echo "<p> " . $row["add"] . "</p>";
            echo "<form action='reserve.php' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "<button class='btn btn-primary' name='reserve'>Rezerwacja</button>";
            echo "</div>";
            echo "</div>";
        }

    mysqli_close($conn);
        
    ?>
    <br>
    <footer class="py-3 bg-light">
        <div class="footer">
            <p>© 2023 SłopHotel. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>
</body>
</html>
