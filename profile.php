<?php
    session_start();
    if (!isset($_SESSION["loggedin"])) {
        header("Location: login-register.php");
    }

    include "functions.php";


    //aktuális felhasználó adatai
    $user=$_SESSION["user"];
    $user_name=$user["username"];
    $user_email=$user["email"];
    $user_picture=$_SESSION["user_pic"];

   
    $user_id=$user["id"];


    //delete account
    if(isset($_POST["delete"])){
        /*
        //megerősítés
        echo "<form method='post' action='profile.php'>";
        echo "Are you sure to delte your account?<br>";
        echo "<input class='btn' type='submit' name='delete_confirm' value='Delete'>";
        echo "<input class='btn' type='submit' name='no' value='No'>";
        echo "</form>";
        */
        //ha törölni akarja
        $succsess=delte_user($user_id);

        if($succsess==false){
            die("Error during delting the account!");
        }else{
            session_unset();
            session_destroy();
            header("Location: login-register.php");
        }
    }


?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="authors" content="Földes Gergely, Czellár Botond">
    <meta name="description" content="licenciába adás">
    <meta name="keywords" content="HTML,CSS,webterv">
    <link rel="icon" href="assets/img/icon.jpg">
    <title>BEAT STORE</title>

    <!--css-->
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


</head>
<!--valamiért css-ben nem működik a background-->
<body>
    <!--navbar&logo-->
    <header class="header">
        <input type="checkbox" id="check">
        <label for="check">
            <img src="assets/img/menu2.png" alt="menu" id="btn" class="menu_icon">
            <img src="assets/img/xmenu.png" alt="menu" id="cancel" class="xmenu_icon">
        </label>
        <a href="beat.php" class="logo">BEAT STORE</a>
        <nav class="navbar">
            <ul class="header_menu">
                <li><a href="tracks.php" class="menus">Tracks</a></li>
                <li><a href="licensing.php" class="menus">Licensing</a></li>
                <li><a href="sell.php" class="menus">Sell your music</a></li>
                <li><a href="contact.php" class="menus">Contact</a></li>
            </ul>
            <div>
                <a href="profile.php"><img class="profile-picture" src="<?php echo "$user_picture" ?>" alt="profile_picture"></a>
            </div>
        </nav>
    </header>
    
    <main class="main_body">
        <!--Profile-->
        <div class="container">
            <!--menü-->
            <div class="profile-menu">
                <div>
                    <img class="profile-picture" src="<?php echo "$user_picture" ?>" alt="profile_picture">
                </div>
                <ul class="datas">
                    <li><a class="active" href="profile.php">My profile</a></li>
                    <hr>
                    <li><a href="mymusic.php">My musics</a></li>
                    <hr>
                    <li><a href="editdata.php">Edit data</a></li>   <!--change password|edit profile picture-->
                    <hr>
                </ul>
            </div>
            <!--adatok, a menü alapján-->
            <div class="profile-data">
                <ul class="datas">
                    <ul>
                        <h2>Username</h2>
                        <li><?php echo "$user_name" ?></li>
                    </ul>
                    <ul>
                        <h2>Email</h2>
                        <li><?php echo "$user_email" ?></li>
                    </ul>
                    <ul>
                        <h2>Profile picture's path</h2>
                        <li><?php echo "$user_picture" ?></li>
                    </ul>
                    <ul>
                        <h2>Logout</h2>
                        <li><form action="logout.php"><input name="submit" class="btn" type="submit" value="Logout"></form></li>
                    </ul>
                    <ul>
                        <h2>Delete account</h2>
                        <li><form action="profile.php" method="post"><input name="delete" type="hidden" value="1">
                        <button type="submit" class="btn" onclick="return confirm('Are you sure to delte your account?')">Delete account</button>
                        </form></li>
                    </ul>
                </ul>
            </div>
            <img class="waves-picture" src="assets/img/waves.png" alt="waves_picture">
        </div>
    </main>

        <!--footer-->
    <footer class="footer">
        <div class="footer_container">
            <div class="footer_row">
                <div class="footer-col">
                    <h4>Beat Store</h4>
                    <ul>
                        <li><a href="licensing.php">About us</a></li>
                        <li><a href="#">Merch</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="login-register.php">Register</a></li>
                        <li><a href="login-register.php">Login</a></li>
                        <li><a href="contact.php">Contact us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Social Media</h4>
                    <div class="social">
                        <ul>
                            <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="https://www.instagram.com/unico_uniuni/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="https://www.facebook.com/profile.php" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                            <li><a href="https://www.mme.hu/" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="beatStore2023">&copy; 2023 Beat Store</p>
        </div>
    </footer>

    <script src="#"></script>
</body>
</html>