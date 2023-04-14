<?php
    session_start();
    include "functions.php";
    
    //aktuális felhasználó adatai

    $user_id=$_SESSION["user"]["id"];
    $user_name=$_SESSION["user"]["username"];
    $user_email=$_SESSION["user"]["email"];
    //alap prof.lép
    $user_picture=$_SESSION["user_pic"];


    $user_musics=list_mymusic($user_id);
    $user_musics_id=$user_musics["music_id"];



    $beats = get_music_by($user_name);

    //$target_music="assets/audio/"."*-".$user_id."-*";    //zenék, amik az adott user id-hoz tartoznak
    //$target_cover="assets/uploads".$;


    
    
    


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
    <!-----navbar&logo----->
    <!--
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
    -->
    
    <main class="main_body">
        <!-----Profile----->
        <div class="container">
            <!--menü-->
            <div class="profile-menu">
                <div>
                    <img class="profile-picture" src="<?php echo "$user_picture" ?>" alt="profile_picture">
                </div>
                <ul class="datas">
                    <li><a href="profile.php">My profile</a></li>
                    <hr>
                    <li><a class="active" href="mymusic.php">My musics</a></li>
                    <hr>
                    <li><a href="editdata.php">Edit data</a></li>   <!--change password|edit profile picture-->
                    <hr>
                </ul>
            </div>
            <!--audiók-->
            <div class="mymusics">
                <div class="slider_head">
                    <h2>My tracks</h2>
                    <div class="slider-btn">
                        <img id="left_scroll" src="assets/img/arrow_left.png" alt="left_arrow">
                        <img id="right_scroll" src="assets/img/arrow_right.png" alt="right_arrow">
                    </div>
                </div>
                <ul class="slider_content">
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat1.jpg" alt="beat1" onclick="document.getElementById('audio_play1').play(); return false;"/>
                            <audio id="audio_play1">
                                <source src="assets/audio/andromeda.mp3">
                            </audio>
                        </div>
                        <h3>ANDROMEDA</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat2.jpg" alt="beat2" onclick="document.getElementById('audio_play2').play(); return false;"/>
                            <audio id="audio_play2">
                                <source src="assets/audio/sidekick.mp3">
                            </audio>
                        </div>
                        <h3>sidekick</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat3.jpg" alt="beat3" onclick="document.getElementById('audio_play3').play(); return false;"/>
                            <audio id="audio_play3">
                                <source src="assets/audio/triumph.mp3">
                            </audio>
                        </div>
                        <h3>Triumph</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat4.jpg" alt="beat4" onclick="document.getElementById('audio_play4').play(); return false;"/>
                            <audio id="audio_play4">
                                <source src="assets/audio/parallel.mp3">
                            </audio>
                        </div>
                        <h3>parallel</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat5.jpg" alt="beat5" onclick="document.getElementById('audio_play5').play(); return false;"/>
                            <audio id="audio_play5">
                                <source src="assets/audio/feverdream.mp3">
                            </audio>
                        </div>
                        <h3>feverdream</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat6.jpg" alt="beat6" onclick="document.getElementById('audio_play6').play(); return false;"/>
                            <audio id="audio_play6">
                                <source src="assets/audio/brainfog.mp3">
                            </audio>
                        </div>
                        <h3>Brainfog</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat7.jpg" alt="beat7" onclick="document.getElementById('audio_play7').play(); return false;"/>
                            <audio id="audio_play7">
                                <source src="assets/audio/otherwordly.mp3">
                            </audio>
                        </div>
                        <h3>otherworldly</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                    <li class="music_card">
                        <div class="img_player">
                            <img class="audio-img" src="assets/img/beat8.jpg" alt="beat8" onclick="document.getElementById('audio_play8').play(); return false;"/>
                            <audio id="audio_play8">
                                <source src="assets/audio/thankful.mp3">
                            </audio>
                        </div>
                        <h3>thankful</h3>
                        <p class="title">$24.5 | 123 BPM</p>
                    </li>
                </ul>
            </div>
            <img class="waves-picture" src="assets\img\waves.png" alt="waves_picture">
        </div>
    </main>

        <!-----footer----->
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
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
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