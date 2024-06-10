<?php
include 'config.php';

if (isset($_POST['day'])) {
    $day = mysqli_real_escape_string($conn, $_POST['day']);

    $query = "SELECT id, activity, time, available_slots FROM activities WHERE day = '$day'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">Izvēlaties aktivitāti</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . $row['activity'] . ' (' . $row['time'] . ') - Pieejamas vietas: ' . $row['available_slots'] . '</option>';
        }
    } else {
        echo '<option value="">Nav pieejamu aktivitāšu</option>';
    }
} else {
    echo '<option value="">Nav pieejamu aktivitāšu</option>';
}
?>
