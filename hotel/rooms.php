<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css" integrity="sha384-5QFXyVb+lrCzdN228VS3HmzpiE7ZVwLQtkt+0d9W43LQMzz4HBnnqvVxKg6O+04d" crossorigin="anonymous">
    <link rel="stylesheet" href="tables.css">
    <title>Dostępne pokoje</title>
</head>

<body>
    <br>
    <a id="bti" href="index.html" class="btn btn-secondary">Powrót</a>
    <hr>
    <br>
    <div class="container">
        <h1>Dostępne pokoje:</h1>
        <br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Zdjęcie</th>
                    <th>Numer pokoju</th>
                    <th>Cena (zł/dzień)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'hotel');
        $query = "SELECT * FROM rooms ORDER BY number";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_array($result)) 
            {
                echo "<tr>";
                echo "<td><img src='" . $row["img"] . "' style='max-width:100px'></td>";
                echo "<td>" . $row["number"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<form action='room_info.php' method='post'>";
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo "<td><button class='btn btn-primary' name='reserve'>Dodatkowe Informacje</button></td>";
                echo "</form>";
                echo "</tr>";
            }
        }

        if(isset($_POST['reserve']))
        {
            $room_id = $_POST['room_id'];
        }

        mysqli_close($conn);
        ?>
            </tbody>
        </table>
    </div>
    <br>
    <footer class="py-3 bg-light">
        <div class="footer">
            <p>© 2023 SłopHotel. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>
</body>
</html>
