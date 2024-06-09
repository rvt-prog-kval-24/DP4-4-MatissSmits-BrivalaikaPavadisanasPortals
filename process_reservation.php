<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Izveidot savienojumu
$conn = new mysqli($servername, $username, $password, $dbname);

// Pārbaudīt savienojumu
if ($conn->connect_error) {
    die("Savienojuma kļūda: " . $conn->connect_error);
}

// Iegūt datus no veidlapas
$first_name = $_POST['fname'];
$last_name = $_POST['sname'];
$phone_number = $_POST['nphone'];
$email = $_POST['email'];
$activity = $_POST['activity'];
$reservation_date = $_POST['date'];
$reservation_time = $_POST['time'];
$message = $_POST['message'];

// Sagatavot SQL vaicājumu
$sql = "INSERT INTO reservations (first_name, last_name, phone_number, email, activity, reservation_date, reservation_time, message) 
VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$activity', '$reservation_date', '$reservation_time', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Rezervācija veiksmīgi saglabāta!";
} else {
    echo "Kļūda: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
