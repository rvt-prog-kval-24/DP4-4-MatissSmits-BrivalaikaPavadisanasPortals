<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_name'])) {
    header('Location: login_form.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch distinct days from activities
$days_query = "SELECT DISTINCT day FROM activities ORDER BY FIELD(day, 'Svētdiena', 'Pirmdiena', 'Otradiena', 'Trešdiena', 'Ceturtdiena', 'Piektdiena', 'Sestdiena')";
$days_result = mysqli_query($conn, $days_query);
$days = [];
while ($row = mysqli_fetch_assoc($days_result)) {
    $days[] = $row['day'];
}

// Handle messages
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

// Clear session messages
unset($_SESSION['message']);
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BrivaLaikaPavadisanasPortals, Latvija">
    <meta name="keywords" content="BrivaLaikaPavadisanasPortals, gym, Spelulaukums, aktivitates, Latvija">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&family=Montserrat:wght@300&family=Open+Sans:ital@1&display=swap" rel="stylesheet">
    <title>Brīvā Laika Pavadīšanas Portāls - Rezervācija</title>
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

        #reservation-form {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #reservation-form p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        #reservation-form form {
            display: flex;
            flex-direction: column;
        }

        .line-box {
            border: none;
            margin-bottom: 20px;
        }

        .fill-out {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #tell-more {
            flex-direction: column;
        }

        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .send-button {
            padding: 10px 20px;
            background: #5a8f7b;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .send-button:hover {
            background: #457c63;
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
            text-align: center;
        }

        .modal-btn {
            padding: 10px 20px;
            background: #5a8f7b;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 10px;
        }

        .modal-btn:hover {
            background: #457c63;
        }
    </style>
</head>

<body class="background-img">

    <!-- Logo, menu linki -->
    <header>
        <div id="hero">
            <h1 id="logo"><i class="fa-solid fa-tree"></i> Briva Laika Pavadisanas Portals <i class="fa-solid fa-person-walking"></i></h1>
        </div>
        <nav>
            <ul id="menu-link">
                <li>
                    <a href="index.php">Mājas</a>
                </li>
                <li>
                    <a href="news.php">Jaunumi</a>
                </li>
                <li>
                    <a href="gallery.php">Galerija</a>
                </li>
                <li>
                    <a href="contactus.php">Kontakti</a>
                </li>
                <li>
                    <a class="active-page" href="reservation.php">Rezervācija</a>
                </li>
                <?php if(isset($_SESSION['user_name'])): ?>
                    <?php if($_SESSION['user_type'] == 'admin'): ?>
                        <li><a href="admin_page.php">Admin</a></li>
                    <?php else: ?>
                        <li><a href="profile.php">Profile</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login_form.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <br>
    <!-- Rezervācijas sadaļa -->
    <section id="reservation-form" style="display:block;">
        <h2 class="section-headings">Rezervācija</h2>
        <br>
        <?php if ($message): ?>
            <div class="success-msg"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <p>Lūdzu aizpildiet zemāk esošo veidlapu, lai rezervētu vietu mūsu aktivitātēm. Mēs sazināsimies ar jums, lai apstiprinātu jūsu rezervāciju.</p>
        <form action="process_reservation.php" method="post">
            <fieldset class="line-box">
                <legend>Rezervācijas informācija</legend>
                <label for="day">Diena</label>
                <select class="fill-out" id="day" name="day" required>
                    <option value="">Izvēlaties dienu</option>
                    <?php
                    foreach ($days as $day) {
                        echo "<option value='$day'>$day</option>";
                    }
                    ?>
                </select>
                <label for="activity">Aktivitāte</label>
                <select class="fill-out" id="activity" name="activity_id" required>
                    <option value="">Izvēlaties aktivitāti</option>
                </select>
            </fieldset>
            
            <fieldset id="tell-more" class="line-box">
                <legend>Pastāstiet mums vairāk par savu rezervāciju</legend>
                <label for="message"></label>
                <br>
                <textarea id="message" name="message" cols="80" rows="8" placeholder="Jūsu ziņa" required></textarea>
            </fieldset>
            <button class="send-button" type="submit"><strong>Nosūtīt</strong></button>
        </form>
    </section>
    <!-- Adrese, Laiks, kontakti sociālie tīkli -->
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
    </footer>

    <!-- font awesome script -->
    <script src="https://kit.fontawesome.com/c2f4ffc429.js" crossorigin="anonymous"></script>
    <!-- jQuery script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
            $('#day').change(function() {
                var selectedDay = $(this).val();
                if (selectedDay) {
                    $.ajax({
                        url: 'get_activities.php',
                        type: 'POST',
                        data: { day: selectedDay },
                        success: function(response) {
                            $('#activity').html(response);
                        }
                    });
                } else {
                    $('#activity').html('<option value="">Izvēlaties aktivitāti</option>');
                }
            });
    </script>
</body>

</html>
