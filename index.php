<?php
include 'config.php';

$days = ['Svētdiena', 'Pirmdiena', 'Otradiena', 'Trešdiena', 'Ceturtdiena', 'Piektdiena', 'Sestdiena'];
$activities = [];

foreach ($days as $day) {
    $select = "SELECT * FROM activities WHERE day = '$day' ORDER BY time ASC";
    $result = mysqli_query($conn, $select);
    $activities[$day] = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BrivaLaikaPavadisanasPortals, Latvija">
    <meta name="keywords" content="BrivaLaikaPavadisanasPortals, gym, SpeluLaukums, aktivitates, Latvija">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&family=Montserrat:wght@300&family=Open+Sans:ital@1&display=swap" rel="stylesheet">
    <title>Briva laika Pavadisanas Portals</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: url('/images/background.jpg') no-repeat center center fixed;
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
            font-size: 1.5rem;
            margin: 20px 0;
            animation: fadeIn 1s ease-in-out;
        }

        section {
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            margin: 20px 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }

        #intro {
            max-width: 800px;
            text-align: center;
            line-height: 1.6;
            margin: 0 auto;
        }

        .about-us-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .about-us {
            background: rgba(255, 255, 255, 0.9);
            margin: 10px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(90, 143, 123, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex: 1;
            max-width: 300px;
            text-align: center;
        }

        .about-us:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 20px rgba(90, 143, 123, 0.7);
        }

        .about-us-headings {
            font-size: 1.25rem;
            color: #5a8f7b;
            margin-bottom: 10px;
        }

        hr {
            border: none;
            height: 2px;
            background: #5a8f7b;
            width: 50px;
            margin: 10px auto;
        }

        #activities-times {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .times {
            background: rgba(255, 255, 255, 0.9);
            margin: 10px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            text-align: center;
        }

        footer {
            text-align: center;
            background: #5a8f7b;
            color: #fff;
            padding: 20px;
            position: relative;
            bottom: 0;
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="background-img">
    <!--Logo, Foto and menu linki-->
    <header>
        <div id="hero">
            <h1 id="logo"><i class="fa-solid fa-tree"></i> Briva Laika Pavadisanas Portals <i class="fa-solid fa-person-walking"></i>
            </h1>
        </div>
        <nav>
            <ul id="menu-link">
                <li><a class="active-page" href="index.php">Mājas</a></li>
                <li><a href="news.html">Jaunumi</a></li>
                <li><a href="gallery.html">Galerija</a></li>
                <li><a href="contactus.html">Kontakti</a></li>
                <li><a href="login_form.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <!--Ievada sadaļa-->
    <h2 class="section-headings">Perfekta vieta priekš Jums!</h2>
    <br>
    <section>
        <p id="intro">Briva Laika Pavadisanas Portals tika izveidota ar misiju motivēt ģimenes praktizēt vingrinājumus. Jums nav jāuztraucas par to, kurš iebildīs pret bērniem, kamēr jūs veicat savus vingrinājumus, vai par to, ko jūs darīsit, kamēr bērni veiks savus vingrinājumus aktivitātes. Šeit ir aktivitātes ikvienam (bērniem, kas vecāki par 5 gadiem). <a href="contactus.html">Kontakti</a> lai iegūtu papildinformāciju par mūsu pakalpojumiem un dalību, vai vienkārši rezervējiet savus laika nišas, un strādāsim ārā!</p>
        <br>
        <div class="about-us-container">
            <div class="about-us">
                <h3 class="about-us-headings">Trenniņi <i class="fa-solid fa-dumbbell"></i></h3>
                <hr>
                <p>Ar lielu apsildāmu peldbaseinu un trenažieru zāli ar modernu aprīkojumu nav attaisnojuma, lai nedarbotos.</p>
            </div>

            <div class="about-us">
                <h3 class="about-us-headings">Bērnu aktivitātes <i class="fa-brands fa-slideshare"></i></h3>
                <hr>
                <p>Neuztraucieties par laikapstākļiem, mums ir aktivitātes katram gadalaikam. Mūsu iekštelpu/āra rotaļu laukums un sintētiskais lauks tika izveidots, lai nodrošinātu bērniem aktivitātes IESLĒGTS visa gada garumā.</p>
            </div>

            <div class="about-us">
                <h3 class="about-us-headings">Paņem pauzi <i class="fa-solid fa-mug-hot"></i></h3>
                <hr>
                <p>Nepieciešams pārtraukums? Mūsu kafejnīca ir lieliska vieta, kur pasēdēt un baudīt mūsu veselīgo ēdienkarti elpot. Dalībai ir 10% ATLAIDE!</p>
            </div>
        </div>
    </section>
    <!--Extra aktivitāšu sadaļa-->
    <h2 class="section-headings">Extra Aktivitātes</h2>
    <br>
    <section id="activities-times">
        <?php
        foreach ($days as $day) {
            echo '<div class="times">';
            echo "<h3>$day</h3>";
            if (!empty($activities[$day])) {
                foreach ($activities[$day] as $activity) {
                    echo "<h4>{$activity['activity']}</h4>";
                    echo "<h4>{$activity['time']}</h4>";
                }
            } else {
                echo "<h4>Šajā dienā nav aktivitāšu</h4>";
            }
            echo '</div>';
        }
        ?>
    </section>
    <!--Address, Laiks, kontakti and Sociālie tīkli-->
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
</body>

</html>
