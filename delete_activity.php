<?php
include 'config.php';

$response = ['status' => 'error', 'message' => 'Kļūda dzēšot aktivitāti!'];

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $delete = "DELETE FROM activities WHERE id = $id";
    
    if (mysqli_query($conn, $delete)) {
        $response['status'] = 'success';
        $response['message'] = 'Aktivitāte dzēsta veiksmīgi!';
    }
}

echo json_encode($response);
?>
