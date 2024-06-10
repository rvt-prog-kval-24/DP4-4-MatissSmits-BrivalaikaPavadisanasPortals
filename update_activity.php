<?php
include 'config.php';

$response = ['status' => 'error', 'message' => 'Kļūda atjauninot aktivitāti!'];

if (isset($_POST['edit_activity'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $day = mysqli_real_escape_string($conn, $_POST['day']);
    $activity = mysqli_real_escape_string($conn, $_POST['activity']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $max_slots = (int) $_POST['max_slots'];

    $update = "UPDATE activities SET day = '$day', activity = '$activity', time = '$time', max_slots = $max_slots, available_slots = $max_slots WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        $response['status'] = 'success';
        $response['message'] = 'Aktivitāte atjaunināta veiksmīgi!';
    }
}

echo json_encode($response);
?>
