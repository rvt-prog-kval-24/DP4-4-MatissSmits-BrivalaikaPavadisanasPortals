<?php
include 'config.php';

// Iegūst šodienas datumu
$today = date('Y-m-d');

// Atjauno pieejamo vietu skaitu aktivitātēm, kuru datums ir šodien
$reset_slots_query = "UPDATE activities SET available_slots = max_slots WHERE date = '$today'";
if (mysqli_query($conn, $reset_slots_query)) {
    echo "Slots reset successfully for $today!";
} else {
    echo "Error resetting slots for $today: " . mysqli_error($conn);
}

// Iztīra iepriekšējās dienas rezervācijas
$yesterday = date('Y-m-d', strtotime('-1 day'));
$delete_reservations_query = "DELETE reservations FROM reservations 
                              JOIN activities ON reservations.activity_id = activities.id 
                              WHERE activities.date = '$yesterday'";
if (mysqli_query($conn, $delete_reservations_query)) {
    echo "Reservations deleted successfully for $yesterday!";
} else {
    echo "Error deleting reservations for $yesterday: " . mysqli_error($conn);
}

// Atjauno aktivitātes datumus uz nākamo nedēļu
$update_dates_query = "UPDATE activities SET date = DATE_ADD(date, INTERVAL 7 DAY) WHERE date = '$yesterday'";
if (mysqli_query($conn, $update_dates_query)) {
    echo "Activity dates updated successfully!";
} else {
    echo "Error updating activity dates: " . mysqli_error($conn);
}
?>
