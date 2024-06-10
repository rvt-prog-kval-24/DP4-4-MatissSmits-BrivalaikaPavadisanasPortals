<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$activity_id = mysqli_real_escape_string($conn, $_POST['activity_id']);
$message = mysqli_real_escape_string($conn, $_POST['message']);
$reservation_date = date('Y-m-d');

// Check if the user has already reserved this activity on the same date
$check_query = "SELECT * FROM reservations WHERE user_id = $user_id AND activity_id = $activity_id AND reservation_date = '$reservation_date'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    $_SESSION['error'] = 'Jūs jau esat rezervējis šo aktivitāti šajā datumā.';
    header('Location: reservation.php');
    exit();
}

// Fetch the available slots for the activity
$activity_query = "SELECT available_slots FROM activities WHERE id = $activity_id";
$activity_result = mysqli_query($conn, $activity_query);
$activity = mysqli_fetch_assoc($activity_result);

if (!$activity) {
    $_SESSION['error'] = 'Aktivitāte nav atrasta.';
    header('Location: reservation.php');
    exit();
}

if ($activity['available_slots'] <= 0) {
    $_SESSION['error'] = 'Nav pieejamu vietu šai aktivitātei.';
    header('Location: reservation.php');
    exit();
}

// Insert the reservation
$reserve_query = "INSERT INTO reservations (user_id, activity_id, message, reservation_date) VALUES ($user_id, $activity_id, '$message', '$reservation_date')";
if (mysqli_query($conn, $reserve_query)) {
    // Decrement the available slots
    $update_slots_query = "UPDATE activities SET available_slots = available_slots - 1 WHERE id = $activity_id";
    mysqli_query($conn, $update_slots_query);
    
    $_SESSION['message'] = 'Rezervācija veiksmīga.';
} else {
    $_SESSION['error'] = 'Kļūda veicot rezervāciju.';
}

header('Location: reservation.php');
exit();
?>
