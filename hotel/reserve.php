<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css" integrity="sha384-5QFXyVb+lrCzdN228VS3HmzpiE7ZVwLQtkt+0d9W43LQMzz4HBnnqvVxKg6O+04d" crossorigin="anonymous">
    <link rel="stylesheet" href="reservation.css">
    <title>Rezerwacja</title>
</head>
<body>
    <br>
    <a id="bti" href="rooms.php" class="btn btn-secondary">Powrót</a>
    <hr>
<?php
    $conn = mysqli_connect('localhost', 'root', '', 'hotel');
    $room_id = $_POST['id'];
    $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
    $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : '';

    $rooms = "SELECT * FROM rooms WHERE id=$room_id";
    $result_room = mysqli_query($conn, $rooms);

    if (mysqli_num_rows($result_room) > 0) 
    {
        $row = mysqli_fetch_assoc($result_room);
        echo "<h1 style='text-align: center'> <strong>" . "Pokój numer: " . $row["number"] . "</strong></h1>";
    }
?>
    <hr>
    <div class="container">
        <br>
        <form method="POST" action="">
        <?php
        $check = "SELECT * FROM reservations WHERE id = $room_id AND ((fromDate <= '$fromDate' AND toDate >= '$fromDate') OR (fromDate <= '$toDate' AND toDate >= '$toDate') OR (toDate BETWEEN '$fromDate' AND '$toDate') OR (fromDate BETWEEN '$fromDate' AND '$toDate'))";
        $result_check = mysqli_query($conn, $check);

        $price = "SELECT price * DATEDIFF('$toDate', '$fromDate') AS totalPrice FROM rooms WHERE id = $room_id";
        $result_price = mysqli_query($conn, $price);
        $row_price = mysqli_fetch_assoc($result_price);
        $total_price = $row_price['totalPrice'];

        $insert = "INSERT INTO reservations (id, fromDate, toDate, totalPrice) VALUES ('$room_id', '$fromDate', '$toDate', DATEDIFF('$toDate', '$fromDate') * $total_price)";

        if ($room_id && $fromDate && $toDate) 
        {
            if(mysqli_num_rows($result_check) == 0) 
            {
                $result = mysqli_query($conn, $insert);
                if ($result) 
                {
                    echo "<p>Rezerwacja została dodana.</p>";
                    header("Location: payments.php");
                }
            } 
            else 
            {
                echo '<div class="alert alert-dismissible alert-danger"><strong>Błąd!</strong> Ten termin jest niedostępny.</div>';
            }
        } 
        else 
        {
            echo '<div class="alert alert-dismissible alert-warning"><h4 class="alert-heading">Uwaga!</h4><p class="mb-0">Wszystkie pola są wymagane.</p></div>';
        }
?>
            <div class="form-group">
                <label for="fromDate">Data rozpoczęcia rezerwacji:</label>
                <input type="date" class="form-control" id="fromDate" min="" max="" name="fromDate">
            </div>
            <div class="form-group">
                <label for="toDate">Data zakończenia rezerwacji:</label>
                <input type="date" class="form-control" id="toDate" max="" name="toDate">
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
        <br>
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Zarezerwuj</button>
        </div>
        </form>
        <br>
    <footer class="py-3 bg-light">
        <div class="container">
            <p>© 2023 SłopHotel. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>
</body>
</html>

<script type="text/javascript">
    var fromDate;
    $('#fromDate').on('change', function()
    {
        fromDate = $(this).val();
        $('#toDate').prop('min', function()
        {
            return fromDate;
        })
    });

    var toDate;
    var today;
    $('#toDate').on('change', function()
    {
        toDate = $(this).val();
        $('#fromDate').prop('max', function()
        {
            return toDate;
        });
    });
</script>