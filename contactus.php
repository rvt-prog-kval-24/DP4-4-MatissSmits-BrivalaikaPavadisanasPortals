<?php
include 'config.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BrivaLaikaPavadisanasPortals, Latvija">
    <meta name="keywords" content="BrivaLaikaPavadisanasPortals, gym, Spelulaukums, aktivitates, latvija">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&family=Montserrat:wght@300&family=Open+Sans:ital@1&display=swap" rel="stylesheet">
    <title>Briva Laika Pavadisanas Portals</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../BrivalaikaPavadisanasPortals/assets/images/BrivalaikaPavadisanasPortals/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../BrivalaikaPavadisanasPortals/assets/images/BrivalaikaPavadisanasPortals/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../BrivalaikaPavadisanasPortals/assets/images/BrivalaikaPavadisanasPortals/favicon-16x16.png">

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

        .section-headings {
            text-align: center;
            font-size: 2rem;
            color: #5a8f7b;
        }

        #contact-us {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #contact-us p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        #contact-box {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #contact-form {
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

<body class="background-img">
    <!--Logo, menu linki-->
    <header>
        <div id="hero">
            <h1 id="logo"><i class="fa-solid fa-tree"></i> Briva Laika Pavadisanas Portals <i class="fa-solid fa-person-walking"></i>
            </h1>
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
                    <a class="active-page" href="contactus.php">Kontakti</a>
                </li>
                <li>
                    <a href="reservation.php">Rezervācija</a>
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
    <!--Kontakti-->
    <section id="contact-us">
        <h2 class="section-headings">Kontakti</h2>
        <br>
        <p>Mums ir svarīgi, lai mūsu klienti tiktu informēti. Ja jums ir kādi jautājumi vai vēlaties iegūt vairāk informācijas
            par mūsu aktivitātēm vai rezervācijām, lūdzu, sazinieties ar mums, izmantojot tālāk esošo veidlapu.  Aicinām arī zvanīt. Mēs esam šeit no pirmdienas līdz sestdienai.</p>
    </section>
    <br>
    <section id="contact-box">
        <?php
        if (isset($_SESSION['success'])) {
            echo '<p class="success-msg">'.$_SESSION['success'].'</p>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<p class="error-msg">'.$_SESSION['error'].'</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form id="contact-form" action="submit_contact.php" method="post">
            <h3 id="form-heading">Nosūtiet mums ziņu</h3>
            <fieldset class="line-box">
                <legend>Jūsu informācija</legend>
                <label for="fname">Vārds</label>
                <input class="fill-out" id="fname" name="fname" type="text" placeholder="Ierakstiet jusu vārdu" required>
                <label for="sname">Uzvārds</label>
                <input class="fill-out" id="sname" name="sname" type="text" placeholder="Ierakstiet savu uzvārdu" required>
            </fieldset>

            <fieldset class="line-box">
                <legend>Kontaktu informācija</legend>
                <label for="nphone">Telefona numurs</label>
                <input class="fill-out" id="nphone" name="nphone" type="tel" placeholder="Ierakstiet Jūsu telefona numuru" required pattern="\+?[0-9\s]+">
                <label for="email">Email Adrese</label>
                <input class="fill-out" id="email" name="email" type="email" placeholder="Ierakstiet Jūsu e-pasta adresi" required>
            </fieldset>
            <fieldset class="line-box">
                <legend>Uz ko attiecas jūsu vaicājums</legend>
                <label for="info-list"></label>
                <input class="fill-out" type="text" id="info-list" list="info" name="vairak-info" placeholder="Izvēlaties tēmu" required>
                <datalist id="info">
                    <option value="REzervācija"></option>
                    <option value="Pieteikšanās"></option>
                    <option value="Dalība"></option>
                    <option value="IT problemas"></option>
                    <option value="Citi"></option>
                </datalist>
            </fieldset>
            <fieldset id="tell-more"  class="line-box">
                <legend>Pastāstiet mums vairāk par savu vaicājumu</legend>
                <label for="query-form"></label>
                <br>
                <textarea id="query-form" name="query-form" cols="80" rows="8" placeholder="Jūsu ziņa" required></textarea>
            </fieldset>
            <button class="send-button" type="submit"><strong>Nosūtīt</strong></button>
        </form>
    </section>
    <!--Adrese, Laiks, kontakti sociālie tīkli-->
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

    <!-- font awesome script-->
    <script src="https://kit.fontawesome.com/c2f4ffc429.js" crossorigin="anonymous"></script>
</body>

</html>