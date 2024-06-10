<?php
include 'config.php';

// Get the previous day
$previous_day = date('l', strtotime("-1 day"));

// Reset slots for the previous day
$reset_slots_query = "UPDATE activities SET available_slots = max_slots WHERE day = '$previous_day'";
if (mysqli_query($conn, $reset_slots_query)) {
    echo "Slots reset successfully for $previous_day!";
} else {
    echo "Error resetting slots for $previous_day: " . mysqli_error($conn);
}

// Delete reservations for the previous day
$delete_reservations_query = "DELETE reservations FROM reservations 
                              JOIN activities ON reservations.activity_id = activities.id 
                              WHERE activities.day = '$previous_day'";
if (mysqli_query($conn, $delete_reservations_query)) {
    echo "Reservations deleted successfully for $previous_day!";
} else {
    echo "Error deleting reservations for $previous_day: " . mysqli_error($conn);
}
?>
