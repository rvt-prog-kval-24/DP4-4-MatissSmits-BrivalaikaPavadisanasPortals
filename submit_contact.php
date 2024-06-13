<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $sname = mysqli_real_escape_string($conn, $_POST['sname']);
    $phone = mysqli_real_escape_string($conn, $_POST['nphone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['vairak-info']);
    $message = mysqli_real_escape_string($conn, $_POST['query-form']);

    $insert_query = "INSERT INTO contact_messages (fname, sname, phone, email, subject, message) 
                     VALUES ('$fname', '$sname', '$phone', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['success'] = "Ziņa nosūtīta veiksmīgi!";
    } else {
        $_SESSION['error'] = "Kļūda nosūtot ziņu!";
    }

    header('Location: contactus.php');
}
?>
