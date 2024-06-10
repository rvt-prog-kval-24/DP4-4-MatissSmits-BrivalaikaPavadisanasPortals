<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $update = "UPDATE user_form SET name = '$name', surname = '$surname', email = '$email', phone = '$phone', user_type = '$user_type' WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        echo json_encode(['status' => 'success', 'message' => 'Lietotājs atjaunināts veiksmīgi!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Kļūda atjauninot lietotāju!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
