<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $delete = "DELETE FROM activities WHERE id = $id";
    if (mysqli_query($conn, $delete)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>