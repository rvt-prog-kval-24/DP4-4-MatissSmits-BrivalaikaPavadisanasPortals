<?php
include 'config.php';
session_start();

// Fetch the first news content
$news_query = "SELECT content FROM news_content ORDER BY id ASC LIMIT 1";
$news_result = mysqli_query($conn, $news_query);
$news = mysqli_fetch_assoc($news_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BrivaLaikaPavadisanasPortals, Latvija">
    <meta name="keywords" content="BrivaLaikaPavadisanasPortals, gym, SpeluLaukums, aktivitates, Latvija">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&family=Montserrat:wght@300&family=Open+Sans:ital@1&display=swap" rel="stylesheet">
    <title>Jaunumi</title>
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
            background: #f7f7f7;
            color: #333;
        }

        header {
            background: #5a8f7b;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-family: 'Libre Bodoni', serif;
            font-size: 2.5rem;
            margin: 0;
        }

        nav {
            display: flex;
            justify-content: center;
            background: #457c63;
            padding: 10px 0;
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
            background: #335c4a;
            border-radius: 5px;
        }

        .section-headings {
            text-align: center;
            font-size: 2rem;
            color: #5a8f7b;
            margin: 40px 0 20px;
        }

        #news-box {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #news-box p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        #news-box a {
            color: #5a8f7b;
            text-decoration: none;
            font-weight: bold;
        }

        #news-box a:hover {
            text-decoration: underline;
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
    <!-- Logo, menu links -->
    <header>
        <h1><i class="fa-solid fa-tree"></i> Brīva Laika Pavadīšanas Portāls <i class="fa-solid fa-person-walking"></i></h1>
    </header>
    <nav>
        <ul id="menu-link">
            <li>
                <a href="index.php">Mājas</a>
            </li>
            <li>
                <a class="active-page" href="news.php">Jaunumi</a>
            </li>
            <li>
                <a href="gallery.php">Galerija</a>
            </li>
            <li>
                <a href="contactus.php">Kontakti</a>
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

    <!-- News content section -->
    <section>
        <h2 class="section-headings">Jaunumi</h2>
        <div id="news-box">
            <?php echo nl2br($news['content']); ?>
            <p>Ja ir kādi jautājumi, <a href="contactus.php">sazinieties ar mums</a>.</p>
        </div>
    </section>

    <!-- Address, open time, contact and social media -->
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
