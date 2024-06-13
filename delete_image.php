<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin') {
    exit();
}

if (isset($_POST['id'])) {
    $image_id = $_POST['id'];
    $query = "SELECT image_path FROM gallery_images WHERE id = $image_id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $image_path = $row['image_path'];
        if (unlink($image_path)) {
            $delete_query = "DELETE FROM gallery_images WHERE id = $image_id";
            if (mysqli_query($conn, $delete_query)) {
                echo json_encode(['status' => 'success', 'message' => 'Image deleted successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error deleting image from database!']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting image file!']);
        }
    }
}
?>
