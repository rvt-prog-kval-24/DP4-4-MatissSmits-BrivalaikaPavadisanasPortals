<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO activities (name, description) VALUES ('$name', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Activity added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT id, name, description FROM activities";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin panelis</title>
</head>
<body>
    <h1>Admin panelis</h1>
    <h2>Pievienot aktivitāti</h2>
    <form method="post" action="">
        Vārds: <input type="text" name="name" required><br>
        Apraksts: <textarea name="description" required></textarea><br>
        <button type="submit">Add Activity</button>
    </form>

    <h2>Aktivitates</h2>
    <table border="1">
        <tr>
            <th>Vārds</th>
            <th>Apraksts</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
