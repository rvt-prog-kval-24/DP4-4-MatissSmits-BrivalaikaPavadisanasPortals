<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
}

@include 'config.php';

// Add activity
if (isset($_POST['add_activity'])) {
    $day = mysqli_real_escape_string($conn, $_POST['day']);
    $activity = mysqli_real_escape_string($conn, $_POST['activity']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    
    $insert = "INSERT INTO activities (day, activity, time) VALUES ('$day', '$activity', '$time')";
    
    if (mysqli_query($conn, $insert)) {
        $message = "Aktivitāte pievienota veiksmīgi!";
    } else {
        $error = "Kļūda pievienojot aktivitāti!";
    }
}

// Edit activity
if (isset($_POST['edit_activity'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $day = mysqli_real_escape_string($conn, $_POST['day']);
    $activity = mysqli_real_escape_string($conn, $_POST['activity']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    
    $update = "UPDATE activities SET day = '$day', activity = '$activity', time = '$time' WHERE id = $id";
    
    if (mysqli_query($conn, $update)) {
        $message = "Aktivitāte atjaunināta veiksmīgi!";
    } else {
        $error = "Kļūda atjauninot aktivitāti!";
    }
}

// Filter activities
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

$filter_query .= " ORDER BY FIELD(day, 'Svētdiena', 'Pirmdiena', 'Otradiena', 'Trešdiena', 'Ceturtdiena', 'Piektdiena', 'Sestdiena'), time ASC";
$activities_result = mysqli_query($conn, $filter_query);

$days = ['Svētdiena', 'Pirmdiena', 'Otradiena', 'Trešdiena', 'Ceturtdiena', 'Piektdiena', 'Sestdiena'];

// Fetch users
$users_query = "SELECT * FROM user_form";
$users_result = mysqli_query($conn, $users_query);

// Edit user
if (isset($_POST['edit_user'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    
    $update = "UPDATE user_form SET name = '$name', email = '$email', user_type = '$user_type' WHERE id = $id";
    
    if (mysqli_query($conn, $update)) {
        $message = "Lietotājs atjaunināts veiksmīgi!";
    } else {
        $error = "Kļūda atjauninot lietotāju!";
    }
}

// Delete user
if (isset($_POST['delete_user'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    
    $delete = "DELETE FROM user_form WHERE id = $id";
    
    if (mysqli_query($conn, $delete)) {
        $message = "Lietotājs dzēsts veiksmīgi!";
    } else {
        $error = "Kļūda dzēšot lietotāju!";
    }
}

// Filter users
$filter_name = isset($_POST['filter_name']) ? $_POST['filter_name'] : '';
$filter_email = isset($_POST['filter_email']) ? $_POST['filter_email'] : '';
$filter_user_type = isset($_POST['filter_user_type']) ? $_POST['filter_user_type'] : '';

$user_filter_query = "SELECT * FROM user_form";
$user_conditions = [];

if ($filter_name != '') {
    $user_conditions[] = "name LIKE '%$filter_name%'";
}

if ($filter_email != '') {
    $user_conditions[] = "email LIKE '%$filter_email%'";
}

if ($filter_user_type != '') {
    $user_conditions[] = "user_type = '$filter_user_type'";
}

if (count($user_conditions) > 0) {
    $user_filter_query .= " WHERE " . implode(' AND ', $user_conditions);
}

$user_filter_query .= " ORDER BY id ASC";
$users_result = mysqli_query($conn, $user_filter_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BrivaLaikaPavadisanasPortals, Latvija">
    <meta name="keywords" content="BrivaLaikaPavadisanasPortals, gym, Spelulaukums, aktivitates, latvija">

    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&family=Montserrat:wght@300&family=Open+Sans:ital@1&display=swap" rel="stylesheet">
    <title>Admin Page</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: url('assets/images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        header {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #hero {
            text-align: center;
            padding: 20px 0;
        }

        #logo {
            font-family: 'Libre Bodoni', serif;
            font-size: 2rem;
            color: #5a8f7b;
            animation: fadeInDown 1s ease-in-out;
        }

        nav {
            display: flex;
            justify-content: center;
            background: #5a8f7b;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav li {
            margin: 0 15px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            padding: 10px 15px;
            display: block;
            transition: background 0.3s ease;
        }

        nav a:hover,
        .active-page {
            background: #457c63;
            border-radius: 5px;
        }

        .container {
            display: flex;
            justify-content: center;
            margin: 60px 20px;
            flex-wrap: wrap;
        }

        .sidebar {
            width: 250px;
            background: #5a8f7b;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin: 10px 0;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar a:hover {
            background: #457c63;
        }

        .content {
            flex: 1;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            max-width: 800px;
        }

        .content h2 {
            margin-bottom: 20px;
            color: #5a8f7b;
        }

        form {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        form h3 {
            margin-bottom: 20px;
            color: #5a8f7b;
        }

        form .fill-out {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form .form-btn {
            padding: 10px 20px;
            background: #5a8f7b;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        form .form-btn:hover {
            background: #457c63;
        }

        .activities-container,
        .users-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .activities-table,
        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .activities-table th, .activities-table td,
        .users-table th, .users-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .activities-table th, .users-table th {
            background-color: #5a8f7b;
            color: white;
        }

        .activities-table td a,
        .users-table td a {
            margin-right: 10px;
            color: #5a8f7b;
            text-decoration: none;
        }

        .activities-table td a:hover,
        .users-table td a:hover {
            text-decoration: underline;
        }

        .error-msg {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .success-msg {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        footer {
            text-align: center;
            background: #5a8f7b;
            color: #fff;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        footer ul {
            list-style: none;
            padding: 0;
            margin: 20px 0 10px;
            display: flex;
            justify-content: center;
        }

        footer li {
            margin: 0 10px;
        }

        footer a {
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
        }

        footer a:hover {
            color: #ddd;
        }

        .filter-sidebar {
            width: 250px;
            background: #5a8f7b;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .filter-sidebar h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .filter-sidebar form {
            display: flex;
            flex-direction: column;
        }

        .filter-sidebar form select,
        .filter-sidebar form input,
        .filter-sidebar form .form-btn {
            margin: 10px 0;
        }

        .main-content {
            display: flex;
            width: 100%;
        }
    </style>
</head>

<body>
    <!--Logo, menu linki-->
    <header>
        <div id="hero">
            <a href="index.php" id="page-link">
                <h1 id="logo"><i class="fa-solid fa-tree"></i> BrivaLaikaPavadisanasPortals <i class="fa-solid fa-person-walking"></i>
                </h1>
            </a>    
        </div>
        <nav>
            <ul id="menu-link">
                <li>
                    <a href="index.php">Mājas</a>
                </li>
                <li>
                    <a href="news.html">Jaunumi</a>
                </li>
                <li>
                    <a href="gallery.html">Galerija</a>
                </li>
                <li>
                    <a href="contactus.html">Kontakti</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="sidebar">
            <h3>Admin Panelis</h3>
            <ul>
                <li><a href="#" class="nav-link" data-target="users-container">Lietotāji</a></li>
                <li><a href="#" class="nav-link" data-target="activities-container">Aktivitātes</a></li>
                <li><a href="logout.php">Izrakstīties</a></li>
            </ul>
        </div>

            <div class="content">
                <div class="users-container">
                    <h2>Lietotāju Saraksts</h2>
                    <table class="users-table">
                        <tr>
                            <th>ID</th>
                            <th>Vārds</th>
                            <th>E-pasts</th>
                            <th>Lietotāja tips</th>
                            <th>Darbības</th>
                        </tr>
                        <?php
                        if (mysqli_num_rows($users_result) > 0) {
                            while ($row = mysqli_fetch_assoc($users_result)) {
                                echo '<tr>';
                                echo '<td>'.$row['id'].'</td>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.$row['email'].'</td>';
                                echo '<td>'.$row['user_type'].'</td>';
                                echo '<td>
                                        <a href="#" class="edit-user-btn" data-id="'.$row['id'].'" data-name="'.$row['name'].'" data-email="'.$row['email'].'" data-user_type="'.$row['user_type'].'">Rediģēt</a>
                                        <a href="#" class="delete-user-btn" data-id="'.$row['id'].'">Dzēst</a>
                                      </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">Nav pievienoti lietotāji.</td></tr>';
                        }
                        ?>
                    </table>
                </div>

                <div class="activities-container">
                    <h2>Pievienot Jaunu Aktivitāti</h2>
                    <form action="" method="post">
                        <h3>Aizpildiet formu</h3>
                        <?php
                        if(isset($error)){
                            echo '<span class="error-msg">'.$error.'</span>';
                        }
                        if(isset($message)){
                            echo '<span class="success-msg">'.$message.'</span>';
                        }
                        ?>
                        <select class="fill-out" name="day" required>
                            <option value="" disabled selected>Izvēlieties dienu</option>
                            <?php
                            foreach ($days as $day) {
                                echo "<option value='$day'>$day</option>";
                            }
                            ?>
                        </select>
                        <input class="fill-out" type="text" name="activity" required placeholder="Ievadiet aktivitāti">
                        <input class="fill-out" type="text" name="time" required placeholder="Ievadiet laiku">
                        <input class="form-btn" type="submit" name="add_activity" value="Pievienot">
                    </form>

                    <table class="activities-table">
                        <tr>
                            <th>ID</th>
                            <th>Diena</th>
                            <th>Aktivitāte</th>
                            <th>Laiks</th>
                            <th>Darbības</th>
                        </tr>
                        <?php
                        if (mysqli_num_rows($activities_result) > 0) {
                            while ($row = mysqli_fetch_assoc($activities_result)) {
                                echo '<tr>';
                                echo '<td>'.$row['id'].'</td>';
                                echo '<td>'.$row['day'].'</td>';
                                echo '<td>'.$row['activity'].'</td>';
                                echo '<td>'.$row['time'].'</td>';
                                echo '<td>
                                        <a href="#" class="edit-btn" data-id="'.$row['id'].'" data-day="'.$row['day'].'" data-activity="'.$row['activity'].'" data-time="'.$row['time'].'">Rediģēt</a>
                                        <a href="#" class="delete-btn" data-id="'.$row['id'].'">Dzēst</a>
                                      </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">Nav pievienotas aktivitātes.</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>

            <div class="filter-sidebar">
                <h3>Filtrēt</h3>
                <form action="" method="post" id="filter-form">
                    <!-- Filters for Activities -->
                    <div id="activity-filters">
                        <select class="fill-out" name="filter_day">
                            <option value="">Visas dienas</option>
                            <?php
                            foreach ($days as $day) {
                                $selected = ($filter_day == $day) ? 'selected' : '';
                                echo "<option value='$day' $selected>$day</option>";
                            }
                            ?>
                        </select>
                        <input class="fill-out" type="text" name="filter_activity" placeholder="Filtrēt pēc aktivitātes" value="<?php echo $filter_activity; ?>">
                    </div>

                    <!-- Filters for Users -->
                    <div id="user-filters" style="display: none;">
                        <input class="fill-out" type="text" name="filter_name" placeholder="Filtrēt pēc vārda" value="<?php echo $filter_name; ?>">
                        <input class="fill-out" type="text" name="filter_email" placeholder="Filtrēt pēc e-pasta" value="<?php echo $filter_email; ?>">
                        <select class="fill-out" name="filter_user_type">
                            <option value="">Visi lietotāju tipi</option>
                            <option value="user" <?php echo ($filter_user_type == 'user') ? 'selected' : ''; ?>>Lietotājs</option>
                            <option value="admin" <?php echo ($filter_user_type == 'admin') ? 'selected' : ''; ?>>Administrators</option>
                        </select>
                    </div>
                    <input class="form-btn" type="submit" name="filter" value="Filtrēt">
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Activity -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="" method="post" id="edit-form">
                <h3>Rediģēt Aktivitāti</h3>
                <input type="hidden" name="id" id="edit-id">
                <select class="fill-out" name="day" id="edit-day" required>
                    <?php
                    foreach ($days as $day) {
                        echo "<option value='$day'>$day</option>";
                    }
                    ?>
                </select>
                <input class="fill-out" type="text" name="activity" id="edit-activity" required placeholder="Ievadiet aktivitāti">
                <input class="fill-out" type="text" name="time" id="edit-time" required placeholder="Ievadiet laiku">
                <input class="form-btn" type="submit" name="edit_activity" value="Atjaunināt">
            </form>
        </div>
    </div>

    <!-- Modal for Editing User -->
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="" method="post" id="edit-user-form">
                <h3>Rediģēt Lietotāju</h3>
                <input type="hidden" name="id" id="edit-user-id">
                <input class="fill-out" type="text" name="name" id="edit-user-name" required placeholder="Ievadiet vārdu">
                <input class="fill-out" type="email" name="email" id="edit-user-email" required placeholder="Ievadiet e-pastu">
                <select class="fill-out" name="user_type" id="edit-user-type" required>
                    <option value="user">Lietotājs</option>
                    <option value="admin">Administrators</option>
                </select>
                <input class="form-btn" type="submit" name="edit_user" value="Atjaunināt">
            </form>
        </div>
    </div>

    <!--Footer-->
    <footer class="social-media">
        <h4>Ventspils iela 50 k-4, Latvija</h4>
        <h4>+371 (124) 445 88</h4>
        <h4>Pirmdien - Sestdien - 07:00 - 22:00</h4>
        <br>
        <ul>
            <li>
                <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Apskatiet mūsu facebook lapu (opens in a new tab)"><i class="fa-brands fa-square-facebook"></i></a>
            </li>
            <li>
                <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Apskatiet mūsu Instagram lapu (opens in a new tab)"><i class="fa-brands fa-square-instagram"></i></a>
            </li>
            <li>
                <a href="https://twitter.com" target="_blank" rel="noopener" aria-label="Apskatiet mūsu twitter lapu (opens in a new tab)"><i class="fa-brands fa-square-twitter"></i></a>
            </li>
        </ul>
        <p> Atvainojiet! Mēs nevarējām atrast lapu, kuru meklējat!
            <a href="https://github.com/rvt-prog-kval-24/DP4-4-MatissSmits-BrivalaikaPavadisanasPortals.git/">Aplūkojiet mūsu galveno lapu</a>
        </p>
    </footer>

    <!-- font awesome script-->
    <script src="https://kit.fontawesome.com/c2f4ffc429.js" crossorigin="anonymous"></script>
    <!-- jQuery script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Open edit modal
            $('.edit-btn').on('click', function() {
                $('#edit-id').val($(this).data('id'));
                $('#edit-day').val($(this).data('day'));
                $('#edit-activity').val($(this).data('activity'));
                $('#edit-time').val($(this).data('time'));
                $('#editModal').show();
            });

            // Open edit user modal
            $('.edit-user-btn').on('click', function() {
                $('#edit-user-id').val($(this).data('id'));
                $('#edit-user-name').val($(this).data('name'));
                $('#edit-user-email').val($(this).data('email'));
                $('#edit-user-type').val($(this).data('user_type'));
                $('#editUserModal').show();
            });

            // Close modal
            $('.close').on('click', function() {
                $('#editModal').hide();
                $('#editUserModal').hide();
            });

            // Handle delete activity
            $('.delete-btn').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'delete_activity.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if (response == 'success') {
                            location.reload();
                        } else {
                            alert('Kļūda dzēšot aktivitāti!');
                        }
                    }
                });
            });

            // Handle delete user
            $('.delete-user-btn').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'delete_user.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if (response == 'success') {
                            location.reload();
                        } else {
                            alert('Kļūda dzēšot lietotāju!');
                        }
                    }
                });
            });

            // Navigation functionality
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('.content > div').hide();
                $('.' + target).show();

                // Show the correct filters
                if (target === 'users-container') {
                    $('#user-filters').show();
                    $('#activity-filters').hide();
                } else {
                    $('#user-filters').hide();
                    $('#activity-filters').show();
                }
            });

            // Show activities by default
            $('.activities-container').show();
            $('#activity-filters').show();
        });
    </script>
</body>

</html>
