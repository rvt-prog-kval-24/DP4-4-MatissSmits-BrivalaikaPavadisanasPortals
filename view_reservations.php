<?php
include 'config.php';

$sql = "SELECT r.id, r.user, a.name as activity, r.date, r.time FROM reservations r JOIN activities a ON r.activity_id = a.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rezervācijas</title>
</head>
<body>
    <h1>Rezervācija</h1>
    <table border="1">
        <tr>
            <th>Lietotājs</th>
            <th>Aktivitāte</th>
            <th>Datums</th>
            <th>Laiks</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['user'] ?></td>
                <td><?php echo $row['activity']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['time']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="make_reservation.php">Izveidot rezervāciju</a>
</body>
</html>

<?php
$conn->close();
?>
