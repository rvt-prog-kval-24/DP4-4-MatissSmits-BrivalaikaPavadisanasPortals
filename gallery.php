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
    <meta name="keywords" content="BrivaLaikaPavadisanasPortals, gym, SpeluLaukums, aktivitates, Latvija">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&family=Montserrat:wght@300&family=Open+Sans:ital@1&display=swap"
        rel="stylesheet">
    <title>Brīvā Laika Pavadīšanas Portāls</title>
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

        #galery-page {
            max-width: 80%;
            margin: 20px auto;
            position: relative;
        }

        .slides {
            display: none;
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 10px;
            transition: opacity 1s ease-in-out;
        }

        .active-slide {
            display: block;
            opacity: 1;
        }

        .controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .control-btn {
            background: rgba(255, 255, 255, 0.8);
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 1.5rem;
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 1);
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

        .section-headings {
            text-align: center;
            font-size: 2rem;
            color: #5a8f7b;
            margin-top: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="background-img">
    <!--Logo, atteli,menu linki-->
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
                    <a class="active-page" href="gallery.php">Galerija</a>
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
    </header>
    <!--Galery heading-->
    <h2 class="section-headings">Galerija</h2>
    <!--Galery contents-->
    <section id="galery-page">
        <?php
        $query = "SELECT * FROM gallery_images";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<img class="slides" src="'.$row['image_path'].'" alt="Gallery Image">';
            }
        } else {
            echo '<p>No images found in the gallery.</p>';
        }
        ?>
        <div class="controls">
            <button class="control-btn" id="prev">&#10094;</button>
            <button class="control-btn" id="next">&#10095;</button>
        </div>
    </section>
    <!--Address, laiks, kontakti and Socialie tikli-->
    <footer id="new" class="social-media">
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
    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll(".slides");
        const prev = document.getElementById("prev");
        const next = document.getElementById("next");

        function showSlides() {
            slides.forEach((slide, index) => {
                slide.style.display = "none";
            });
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            slides[slideIndex - 1].style.opacity = 0;
            setTimeout(() => {
                slides[slideIndex - 1].style.opacity = 1;
            }, 10);
            setTimeout(showSlides, 10000); // Change image every 10 seconds
        }

        showSlides();

        prev.addEventListener("click", () => {
            slides[slideIndex - 1].style.display = "none";
            slideIndex--;
            if (slideIndex < 1) { slideIndex = slides.length }
            slides[slideIndex - 1].style.display = "block";
            slides[slideIndex - 1].style.opacity = 0;
            setTimeout(() => {
                slides[slideIndex - 1].style.opacity = 1;
            }, 10);
        });

        next.addEventListener("click", () => {
            slides[slideIndex - 1].style.display = "none";
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            slides[slideIndex - 1].style.opacity = 0;
            setTimeout(() => {
                slides[slideIndex - 1].style.opacity = 1;
            }, 10);
        });
    </script>
</body>

</html>
