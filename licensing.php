<?php
  session_start();
  $user_picture=$_SESSION["user"]["profile_picture"];

?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="style/beat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="style/licensing.css">
</head>
<body>

<header class="header">
    <input type="checkbox" id="check">
    <label for="check">
        <img src="assets/img/menu2.png" alt="menu" id="btn" class="menu_icon">
        <img src="assets/img/xmenu.png" alt="menu" id="cancel" class="xmenu_icon">
    </label>
    <a href="beat.php" class="logo">BEAT STORE</a>
    <nav>
        <ul class="header_menu">
            <li><a href="tracks.php" class="menus">Tracks</a></li>
            <li><a href="licensing.php" class="menus active">Licensing</a></li>
            <li><a href="sell.php" class="menus">Sell your music</a></li>
            <li><a href="contact.php" class="menus">Contact</a></li>
        </ul>
        <?php if (isset($_SESSION["user"])) { ?>
            <div>
                <a href="profile.php"><img class="profile-picture" src="<?php echo "$user_picture" ?>" alt="profile_picture"></a>
            </div>
        <?php } else { ?>
            <div class="connection">
                <a href="login-register.php">Login</a>
            </div>
        <?php } ?>
    </nav>
</header>

<div class="licensing-table">

    <table>
        <caption>Beware, pirates!</caption>
        <tr>
            <th>Private use</th>
            <th>Public non-profit use</th>
            <th>Public for-profit use</th>
        </tr>
        <tr>
            <td>
                You may use the purchased beat(s) for any private
                and non-commercial case without paying royalties
                to the composing artist(s). just don't take the piss.
            </td>
            <td>
                Non-profit use implies no monetary transaction between
            you and a streaming platform, music label or any other entity.
            Should your song hit 2 million combined listeners, you must contact
            the composing artist(s), who are entitled for no more than
            10 times the purchasing price of the beat(s).
            </td>
            <td>
                For-profit use implies monetary transaction between
                you and a streaming platform, music label or any other entity.
                The composer(s) are entitled to 20% of your income from the beat
                they sold. Both in the case of a one-time transaction and any
                subsequent income you may have generated with your song.
            </td>
        </tr>
    </table>

</div>


<footer class="footer">
    <div class="footer_container">
        <div class="footer_row">
            <div class="footer-col">
                <h4>Beat Store</h4>
                <ul>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Merch</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="contact.html">Contact us</a></li>
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

</body>
</html>