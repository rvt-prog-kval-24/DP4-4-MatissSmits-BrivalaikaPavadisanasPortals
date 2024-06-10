<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $delete_query = "DELETE FROM user_form WHERE id = $id";

    if (mysqli_query($conn, $delete_query)) {
        echo json_encode(['status' => 'success', 'message' => 'Lietotājs dzēsts veiksmīgi!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Kļūda dzēšot lietotāju!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
