<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $surname = mysqli_real_escape_string($conn, $_POST['surname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = 'user'; // Always set user_type to 'user'

   $select = "SELECT * FROM user_form WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'lietotājs jau eksistē!';
   }else{
      if($pass != $cpass){
         $error[] = 'parole nesakrīt!';
      }else{
         $insert = "INSERT INTO user_form(name, surname, email, phone, password, user_type) VALUES('$name', '$surname', '$email', '$phone', '$pass', '$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }
};
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
    <title>Reģistrēties</title>
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

        .section-headings {
            text-align: center;
            font-size: 1.5rem;
            margin: 20px 0;
            animation: fadeIn 1s ease-in-out;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        form h3 {
            margin-bottom: 20px;
            color: #5a8f7b;
        }

        form .fill-out {
            width: 90%;
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

        form p {
            margin-top: 20px;
        }

        form p a {
            color: #5a8f7b;
            text-decoration: none;
        }

        form p a:hover {
            text-decoration: underline;
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
    <!--Logo, menu linki-->
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
    
    <!--Register form-->
    <div class="form-container">
        <form action="" method="post">
            <h3>Reģistrēties</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input class="fill-out" type="text" name="name" required placeholder="Ievadiet Jūsu vārdu">
            <input class="fill-out" type="text" name="surname" required placeholder="Ievadiet Jūsu uzvārdu">
            <input class="fill-out" type="email" name="email" required placeholder="Ievadiet Jūsu e-pastu">
            <input class="fill-out" type="text" name="phone" required placeholder="Ievadiet Jūsu telefona numuru">
            <input class="fill-out" type="password" name="password" required placeholder="Ievadiet Jūsu paroli">
            <input class="fill-out" type="password" name="cpassword" required placeholder="Ievadiet Jūsu atkārtoto paroli">
            <input class="form-btn" type="submit" name="submit" value="Reģistrēties">
            <p>Jau ir profils? <a href="login_form.php">Pieslēgties</a></p>
        </form>
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
    </footer>

    <!-- font awesome script-->
    <script src="https://kit.fontawesome.com/c2f4ffc429.js" crossorigin="anonymous"></script>
</body>

</html>
