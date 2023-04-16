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

    $user_musics=array();
    $user_musics=list_mymusic($user_id);
    //megnézzük van-e egyáltalán zenénk az adatbázisban
    if(count($user_musics)==0){
        //ha nincs zenénk
        $have_beats=false;
    }else{
        //ha van zenénk
        $uploads=list_beats_and_covers($user_musics, $user_name);//audio-cover párosok kilistázása
        $have_beats=true;
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
    <link rel="stylesheet" href="style/mymusic.css">
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
                    <li><a href="profile.php">My profile</a></li>
                    <li><a class="active" href="mymusic.php">My musics</a></li>
                    <li><a href="editdata.php">Edit data</a></li>   <!--change password|edit profile picture-->
                </ul>
            </div>
            <!--audiók-->
            <?php if($have_beats==false){ ?>
            <div class="mymusics">
                <h2 class="no-beats">You didn't upload any audio.</h2>
            </div>
            <?php }else{ ?>
            <div class="mymusics">
                <div class="slider_head">
                    <h2>My tracks</h2>
                    <div class="slider-btn">
                        <img id="left_scroll" src="assets/img/arrow_left.png" alt="left_arrow">
                        <img id="right_scroll" src="assets/img/arrow_right.png" alt="right_arrow">
                    </div>
                </div>
                <ul class="slider_content">
                    <?php $i=1; //számláló + music_id + tömb index?>
                    <?php foreach($uploads as $upload) {//a $key music id is egyben?>
                    <?php $actual=list_mymusic_by_music_id($upload[2]); //music_id alapján az aktuális zene adatai ($uploads[2]-ben van a music_id)?>
                    <?php $title=$actual["title"];?>
                    <?php $artist=$actual["artist"];?>
                    <?php $bpm=$actual["bpm"];?>
                    <?php $price=$actual["price"];?>
                    <li class="music_card">
                        <div class="img_player">      <!--$uploads[1][$key] -> azért 1-es az 1. index, mert azon az indexen belül van a covers asszoc. mappa, ahonnan a borító képeket lehet elérni--->
                            <img class="audio-img" src="<?php echo $upload[1] ?>" alt="beat<?php echo $i ?>" onclick="document.getElementById('audio_play<?php echo $i ?>').play(); return false;"/>
                            <audio id="audio_play<?php echo $upload[0] ?>">
                                <source src="<?php echo $beat ?>">
                            </audio>
                        </div>
                        <h3><?php echo $artist ?></h3>
                        <p class="title"><?php echo $title ?></p>
                        <p class="title">$<?php echo $price ?> | <?php echo $bpm ?> BPM</p>
                    </li>
                    <?php $i++; ?>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
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

    <script src="script/scrolls.js"></script>
</body>
</html>