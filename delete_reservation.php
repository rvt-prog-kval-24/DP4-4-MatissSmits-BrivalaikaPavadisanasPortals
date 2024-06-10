<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $delete_query = "DELETE FROM reservations WHERE id = $id";

    if (mysqli_query($conn, $delete_query)) {
        echo json_encode(['status' => 'success', 'message' => 'Rezervācija dzēsta veiksmīgi!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Kļūda dzēšot rezervāciju!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
