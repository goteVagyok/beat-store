<?php
  session_start();
  $user_picture=$_SESSION["user"]["profile_picture"];

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
    <link rel="stylesheet" href="style/beat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>
<body>
    <!-----navbar&logo----->
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

    <main class="main_body">
        <!------new_tracks------>
        <div class="new_tracks">
            <div class="slider_head">
                <h2>New tracks</h2>
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

        <!--Featured-->
        <div class="featured">
            <div class="slider_head">
                <h2>Featured</h2>
                <div class="slider-btn">
                    <img id="left_scroll2" src="assets/img/arrow_left.png" alt="left_arrow">
                    <img id="right_scroll2" src="assets/img/arrow_right.png" alt="right_arrow">
                </div>
            </div>
            <ul class="slider_content2">
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat1.jpg" alt="beat1" onclick="document.getElementById('audio_play11').play(); return false;"/>
                        <audio id="audio_play11">
                            <source src="assets/audio/andromeda.mp3">
                        </audio>
                    </div>
                    <h3>ANDROMEDA</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat2.jpg" alt="beat2" onclick="document.getElementById('audio_play12').play(); return false;"/>
                        <audio id="audio_play12">
                            <source src="assets/audio/sidekick.mp3">
                        </audio>
                    </div>
                    <h3>sidekick</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat3.jpg" alt="beat3" onclick="document.getElementById('audio_play13').play(); return false;"/>
                        <audio id="audio_play13">
                            <source src="assets/audio/triumph.mp3">
                        </audio>
                    </div>
                    <h3>Triumph</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat4.jpg" alt="beat4" onclick="document.getElementById('audio_play14').play(); return false;"/>
                        <audio id="audio_play14">
                            <source src="assets/audio/parallel.mp3">
                        </audio>
                    </div>
                    <h3>parallel</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat5.jpg" alt="beat5" onclick="document.getElementById('audio_play15').play(); return false;"/>
                        <audio id="audio_play15">
                            <source src="assets/audio/feverdream.mp3">
                        </audio>
                    </div>
                    <h3>feverdream</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat6.jpg" alt="beat6" onclick="document.getElementById('audio_play16').play(); return false;"/>
                        <audio id="audio_play16">
                            <source src="assets/audio/brainfog.mp3">
                        </audio>
                    </div>
                    <h3>Brainfog</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat7.jpg" alt="beat7" onclick="document.getElementById('audio_play17').play(); return false;"/>
                        <audio id="audio_play17">
                            <source src="assets/audio/otherwordly.mp3">
                        </audio>
                    </div>
                    <h3>otherworldly</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat8.jpg" alt="beat8" onclick="document.getElementById('audio_play18').play(); return false;"/>
                        <audio id="audio_play18">
                            <source src="assets/audio/thankful.mp3">
                        </audio>
                    </div>
                    <h3>thankful</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat9.jpg" alt="beat8" onclick="document.getElementById('audio_play19').play(); return false;"/>
                        <audio id="audio_play19">
                            <source src="assets/audio/galopp.mp3">
                        </audio>
                    </div>
                    <h3>galopp</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
                <li class="music_card">
                    <div class="img_player">
                        <img class="audio-img" src="assets/img/beat10.jpg" alt="beat8" onclick="document.getElementById('audio_play20').play(); return false;"/>
                        <audio id="audio_play20">
                            <source src="assets/audio/distant.mp3">
                        </audio>
                    </div>
                    <h3>distant</h3>
                    <p class="title">$24.5 | 123 BPM</p>
                </li>
            </ul>
        </div> 


        <!--Artists-->
        <div class="artists">
            <div class="slider_head">
                <h2>Artists</h2>
                <div class="slider-btn">
                    <img id="left_scroll3" src="assets/img/arrow_left.png" alt="left_arrow">
                    <img id="right_scroll3" src="assets/img/arrow_right.png" alt="right_arrow">
                </div>
            </div>
            <ul class="slider_content3">
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist1.jpg" alt="artist1"/>
                    </div>
                    <h3>J.J.</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist2.jpg" alt="artist2"/>
                    </div>
                    <h3>Ben D. Ova</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist3.jpg" alt="artist3"/>
                    </div>
                    <h3>maddow</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist4.jpg" alt="artist4"/>
                    </div>
                    <h3>Etelka</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist5.jpg" alt="artist5"/>
                    </div>
                    <h3>dexter</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist6.jpg" alt="artist6"/>
                    </div>
                    <h3>yuri</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist7.jpg" alt="artist7"/>
                    </div>
                    <h3>Nemet Tube Jel</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist8.jpg" alt="artist8"/>
                    </div>
                    <h3>Fois Pan Peter</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist9.jpg" alt="artist1"/>
                    </div>
                    <h3>boksz</h3>
                </li>
                <li class="artist_card">
                    <div class="img_player">
                        <img class="artist-img" src="assets/img/artist10.jpg" alt="artist1"/>
                    </div>
                    <h3>cicamicaaa *.*</h3>
                </li>
            </ul>
        </div>
    </main>
    
    <!-----footer----->
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
    <!--script-->
    <script src="script/scrolls.js"></script>
</body>
</html>