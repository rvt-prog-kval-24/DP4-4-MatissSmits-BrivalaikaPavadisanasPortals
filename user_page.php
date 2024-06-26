<?php

include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lietotājlapa</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/css/style1.css">

</head>
<body>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BrivaLaikaPavadisanasPortals, Latvija">
    <meta name="keywords" content="BrivaLaikaPavadisanasPortals, gym, SpeluLaukums, aktivitates, Latvija">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&family=Montserrat:wght@300&family=Open+Sans:ital@1&display=swap"
        rel="stylesheet">
    <title>Briva laika Pavadisanas Portals</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
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
                <li>
                    <a class="active-page" href="index.php">Mājas</a>
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
                    <a href="login_form.php">Logout</a>
                    
                </li>
            </ul>
        </nav>
    </header>
    <br>
    <!--Ievada sadaļa-->
    <h2 class="section-headings">Perfekta vieta priekš Jums!</h2>
    <br>
    <section>
        <p id="intro">Briva Laika Pavadisanas Portals tika izveidota ar misiju motivēt ģimenes praktizēt vingrinājumus. Jums nav
            jāuztraucas par to, kurš iebildīs pret bērniem, kamēr jūs veicat savus vingrinājumus, vai par to, ko jūs darīsit, kamēr bērni veiks savus vingrinājumus
            aktivitātes. Šeit ir aktivitātes ikvienam (bērniem, kas vecāki par 5 gadiem). <a href="contactus.html">Kontakti</a> lai iegūtu papildinformāciju par mūsu pakalpojumiem un dalību, vai vienkārši rezervējiet savus laika nišas, un strādāsim
            ārā!
        </p>
        <br>
        <div class="about-us">
            <h3 class="about-us-headings">Trenniņi <i class="fa-solid fa-dumbbell"></i></h3>
            <hr>
            <p>Ar lielu apsildāmu peldbaseinu un trenažieru zāli ar modernu aprīkojumu nav attaisnojuma, lai nedarbotos.
            </p>
        </div>

        <div class="about-us">
            <h3 class="about-us-headings">Bērnu aktivitātes <i class="fa-brands fa-slideshare"></i></h3>
            <hr>
            <p>Neuztraucieties par laikapstākļiem, mums ir aktivitātes katram gadalaikam. Mūsu iekštelpu/āra rotaļu laukums un
                sintētiskais lauks tika izveidots, lai nodrošinātu bērniem aktivitātes IESLĒGTS visa gada garumā.
            </p>
        </div>

        <div class="about-us">
            <h3 class="about-us-headings">Paņem pauzi <i class="fa-solid fa-mug-hot"></i></h3>
            <hr>
            <p>Nepieciešams pārtraukums? Mūsu kafejnīca ir lieliska vieta, kur pasēdēt un baudīt mūsu veselīgo ēdienkarti
                elpot. Dalībai ir 10% ATLAIDE!
            </p>
        </div>
    </section>
    <!--Extra aktivitāšu sadaļa-->
    <h2 class="section-headings">Extra Aktivitātes</h2>
    <br>
    <section id="activities-times">
        <div class="times">
            <h3>Svētdiena</h3>
            <h4>Barbecue</h4>
            <h4>(Dalība)</h4>
            <h4>12:00 - 16:30</h4>
        </div>
        <div class="times">
            <h3>Pirmdiena</h3>
            <h4>Taekwondo</h4>
            <h4>14:00 un 16:00</h4>
            <h4>Peldēšana</h4>
            <h4>15:00 un 17:00</h4>
            <h4>Yoga</h4>
            <h4>18:00</h4>
        </div>
        <div class="times">
            <h3>Otradiena</h3>
            <h4>Ballet</h4>
            <h4>14:00 un 16:00</h4>
            <h4>Zumba</h4>
            <h4>15:00 un 18:00</h4>
        </div>
        <div class="times">
            <h3>trešdiena</h3>
            <h4>Taekwondo</h4>
            <h4>14:00 un 16:00</h4>
            <h4>Peldēšana</h4>
            <h4>15:00 un 17:00</h4>
        </div>
        <div class="times">
            <h3>Ceturtdiena</h3>
            <h4>Ballets</h4>
            <h4>14:00 un 16:00</h4>
            <h4>Zumba</h4>
            <h4>15:00 & 18:00</h4>
        </div>
        <div class="times">
            <h3>Piektdiena</h3>
            <h4>Taekwondo</h4>
            <h4>14:00 un 16:00</h4>
            <h4>Peldēšana</h4>
            <h4>15:00 un 17:00</h4>
            <h4>Yoga</h4>
            <h4>18:00</h4>
        </div>
        <div class="times">
            <h3>Sestdiena</h3>
            <h4>Balets</h4>
            <h4>10:00 un 12:00</h4>
            <h4>Zumba</h4>
            <h4>11:00 un 13:00</h4>
            <h4>Futbols</h4>
            <h4>Bērni (5-12)</h4>
            <h4>14:00</h4>
        </div>
    </section>
    <!--Address, Laiks, kontacti and Sociālie tīkli-->
    <footer class="social-media">
        <h4>Ventspils iela 50 k-4, Latvija</h4>
        <h4>+371 (124) 445 88</h4>
        <h4>Pirmdien - Sestdien - 07:00 - 22:00</h4>
        <br>
        <ul>
            <li>
                <a href="https://facebook.com" target="_blank" rel="noopener"
                    aria-label="Apskatiet mūsu facebook lapu (opens in a new tab)"><i
                        class="fa-brands fa-square-facebook"></i></a>
            </li>
            <li>
                <a href="https://instagram.com" target="_blank" rel="noopener"
                    aria-label="Apskatiet mūsu Instagram lapu (opens in a new tab)"><i
                        class="fa-brands fa-square-instagram"></i></a>
            </li>
            <li>
                <a href="https://twitter.com" target="_blank" rel="noopener"
                    aria-label="Apskatiet mūsu twitter lapu (opens in a new tab)"><i
                        class="fa-brands fa-square-twitter"></i></a>
            </li>
        </ul>
       
    </footer>

    <!-- font awesome script-->
    <script src="https://kit.fontawesome.com/c2f4ffc429.js" crossorigin="anonymous"></script>
</body>
</html>