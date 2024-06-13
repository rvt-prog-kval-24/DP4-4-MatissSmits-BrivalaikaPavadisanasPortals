<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin') {
    exit();
}

$gallery_query = "SELECT * FROM gallery_images";
$gallery_result = mysqli_query($conn, $gallery_query);

if (mysqli_num_rows($gallery_result) > 0) {
    while ($row = mysqli_fetch_assoc($gallery_result)) {
        echo '<tr>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td><img src="'.$row['image_path'].'" alt="Gallery Image" width="100"></td>';
        echo '<td>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="image_id" value="'.$row['id'].'">
                    <input class="form-btn" type="submit" name="delete_image" value="Dzēst">
                </form>
              </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="3">Nav pievienotas bildes.</td></tr>';
}
?>
