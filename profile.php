<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_name'])) {
    header('Location: login_form.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$message = '';
$error = '';

// Fetch user details
$user_query = "SELECT * FROM user_form WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);

// Update user details
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    $update_query = "UPDATE user_form SET name = '$name', surname = '$surname', email = '$email', phone = '$phone' WHERE id = $user_id";
    
    if (mysqli_query($conn, $update_query)) {
        $message = "Profils atjaunināts veiksmīgi!";
    } else {
        $error = "Kļūda atjauninot profilu!";
    }
}

// Fetch user reservations
$reservations_query = "SELECT reservations.*, activities.activity, activities.day, activities.time 
                       FROM reservations 
                       JOIN activities ON reservations.activity_id = activities.id 
                       WHERE reservations.user_id = $user_id";
$reservations_result = mysqli_query($conn, $reservations_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profila lapa</title>
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

        .section-headings {
            text-align: center;
            font-size: 2rem;
            color: #5a8f7b;
            margin-top: 100px;
            margin-bottom: 20px;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            color: #5a8f7b;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .fill-out {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-btn {
            padding: 10px 20px;
            background: #5a8f7b;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-btn:hover {
            background: #457c63;
        }

        .reservations {
            margin-top: 20px;
        }

        .reservations table {
            width: 100%;
            border-collapse: collapse;
        }

        .reservations th, .reservations td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .reservations th {
            background-color: #5a8f7b;
            color: white;
        }

        .success-msg {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }

        .error-msg {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }

        footer {
            text-align: center;
            background: #5a8f7b;
            color: #fff;
            padding: 20px;
            position: relative;
            bottom: 0;
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
    </style>
</head>

<body>
    <header>
    <div id="hero">
            <h1 id="logo"><i class="fa-solid fa-tree"></i> Briva Laika Pavadisanas Portals <i class="fa-solid fa-person-walking"></i></h1>
        </div>
        <nav>
            <ul id="menu-link">
                <li><a href="index.php">Mājas</a></li>
                <li><a href="news.php">Jaunumi</a></li>
                <li><a href="gallery.php">Galerija</a></li>
                <li><a href="contactus.php">Kontakti</a></li>
                <li><a href="reservation.php">Rezervācija</a></li>
                <?php if(isset($_SESSION['user_name'])): ?>
                    <?php if($_SESSION['user_type'] == 'admin'): ?>
                        <li><a href="admin_page.php">Admin</a></li>
                    <?php else: ?>
                        <li><a class="active-page" href="profile.php">Profile</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login_form.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Profils</h2>
        <?php if ($message): ?>
            <div class="success-msg"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="profile.php" method="post">
            <label for="name">Vārds</label>
            <input class="fill-out" type="text" id="name" name="name" value="<?php echo $user_data['name']; ?>" required>
            <label for="surname">Uzvārds</label>
            <input class="fill-out" type="text" id="surname" name="surname" value="<?php echo $user_data['surname']; ?>" required>
            <label for="email">E-pasts</label>
            <input class="fill-out" type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
            <label for="phone">Telefona numurs</label>
            <input class="fill-out" type="tel" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" required>
            <input class="form-btn" type="submit" name="update_profile" value="Atjaunināt profilu">
        </form>

        <div class="reservations">
            <h2>Manas Rezervācijas</h2>
            <table>
                <tr>
                    <th>Diena</th>
                    <th>Aktivitāte</th>
                    <th>Laiks</th>
                    <th>Ziņa</th>
                </tr>
                <?php
                if (mysqli_num_rows($reservations_result) > 0) {
                    while ($row = mysqli_fetch_assoc($reservations_result)) {
                        echo '<tr>';
                        echo '<td>' . $row['day'] . '</td>';
                        echo '<td>' . $row['activity'] . '</td>';
                        echo '<td>' . $row['time'] . '</td>';
                        echo '<td>' . $row['message'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Nav rezervāciju.</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>

    <footer>
        <h4>Ventspils iela 50 k-4, Latvija</h4>
        <h4>+371 (124) 445 88</h4>
        <h4>Pirmdien - Sestdien - 07:00 - 22:00</h4>
        <br>
        <ul>
            <li><a href="https://facebook.com" target="_blank"><i class="fa-brands fa-square-facebook"></i></a></li>
            <li><a href="https://instagram.com" target="_blank"><i class="fa-brands fa-square-instagram"></i></a></li>
            <li><a href="https://twitter.com" target="_blank"><i class="fa-brands fa-square-twitter"></i></a></li>
        </ul>
    </footer>
</body>
</html>
