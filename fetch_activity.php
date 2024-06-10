<?php
include 'config.php';

$filter_day = isset($_POST['filter_day']) ? $_POST['filter_day'] : '';
$filter_activity = isset($_POST['filter_activity']) ? $_POST['filter_activity'] : '';

$filter_query = "SELECT * FROM activities";
$conditions = [];

if ($filter_day != '') {
    $conditions[] = "day = '$filter_day'";
}

if ($filter_activity != '') {
    $conditions[] = "activity LIKE '%$filter_activity%'";
}

if (count($conditions) > 0) {
    $filter_query .= " WHERE " . implode(' AND ', $conditions);
}

$filter_query .= " ORDER BY FIELD(day, 'Pirmdiena', 'Otradiena', 'Trešdiena', 'Ceturtdiena', 'Piektdiena', 'Sestdiena', 'Svētdiena'), time ASC";
$activities_result = mysqli_query($conn, $filter_query);

$output = '';
if (mysqli_num_rows($activities_result) > 0) {
    while ($row = mysqli_fetch_assoc($activities_result)) {
        $output .= '<tr>';
        $output .= '<td>'.$row['id'].'</td>';
        $output .= '<td>'.$row['day'].'</td>';
        $output .= '<td>'.$row['activity'].'</td>';
        $output .= '<td>'.$row['time'].'</td>';
        $output .= '<td>'.$row['max_slots'].'</td>';
        $output .= '<td>'.$row['available_slots'].'</td>';
        $output .= '<td>
                        <a href="#" class="edit-btn" data-id="'.$row['id'].'" data-day="'.$row['day'].'" data-activity="'.$row['activity'].'" data-time="'.$row['time'].'" data-max_slots="'.$row['max_slots'].'">Rediģēt</a>
                        <a href="#" class="delete-btn" data-id="'.$row['id'].'">Dzēst</a>
                    </td>';
        $output .= '</tr>';
    }
} else {
    $output .= '<tr><td colspan="7">Nav pievienotas aktivitātes.</td></tr>';
}
echo $output;
?>
