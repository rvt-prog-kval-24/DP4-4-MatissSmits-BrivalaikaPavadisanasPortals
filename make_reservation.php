<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $activity_id = $_POST['activity_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO reservations (user, activity_id, date, time) VALUES ('$user', '$activity_id', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation made successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT id, name FROM activities";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Izveidot rezervaciju</title>
</head>
<body>
    <h1>Izveidot rezervaciju</h1>
    <form method="post" action="">
        Lietotājs: <input type="text" name="user" required><br>
        Aktivititate: 
        <select name="activity_id" required>
            <?php while($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br>
        Datums: <input type="date" name="date" required><br>
        Laiks: <input type="time" name="time" required><br>
        <button type="submit">Iesniegt</button>
    </form>
    <a href="view_reservations.php">Pārskatīt rezervāciju</a>
</body>
</html>

<?php
$conn->close();
?>
