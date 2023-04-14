<?php

    include "functions.php";
  session_start();
    $user_picture="assets/uploads/profile_picture.png";

if (isset($_SESSION['loggedin'])) {
    // ha be van jelentkezve a felhasznalo  --> ha nincs, akkor máshogy néz ki az oldal amúgy is, nem kell else ág
    $user_picture=$_SESSION["user_pic"];

    $user_id = $_SESSION["user"]["id"];
    $username = $_SESSION["user"]["username"];

    $errors=[];
    $upload_success = false;


    if(isset($_POST["submit"])) {
        //ha meg nem letezik akkor csinalunk neki egy sajat mappat amibe mennek majd a feltoltesei
        if (!file_exists("assets/uploads/".$username)) {
            mkdir("assets/uploads/".$username);
        }

        if(!isset($_FILES["beat"])){
            $errors[]="Upload your beat!";
        }else{


            $beat_path= $_FILES["beat"]["tmp_name"];

            $fileName = $_FILES["beat"]["name"];
            $fileSize = $_FILES["beat"]["size"];
            $fileError = $_FILES["beat"]["error"];

            $target_dir = getcwd() . "assets/audio/";
            $target_file = $target_dir . basename($_FILES['beat']['name']);
            $file_type = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


            //ha mp3 a file, és még nincs az audiók közt
            if($file_type==="mp3" && !file_exists($target_file)){
                if($fileError===0){
                    if($fileSize<31457280){

                        $track_id = get_n_of_uploads_by($username."/") - 2; // valamiert 2-t ad vissza 0 helyett xdd
                        $dir_for_new_beat = "assets/uploads/".$username."/".$track_id;
                        //megcsinaljuk a mappat az adott beatnek es covernek (ha van)
                        if (!file_exists($dir_for_new_beat)) {
                            mkdir($dir_for_new_beat);
                        }

                        //ADATOK ELTÁROLÁSA
                        $title= $_POST["title"];
                        $artist= $_POST["artist"];
                        $bpm= $_POST["bpm"];//num
                        $price= $_POST["price"];//num
                        $music_key= $_POST["key"];

                        //adatbázisba tesszük           FASZÉRT NEM MŰKÖDIK?
                        set_music($user_id, $title, $artist, $price, $bpm, $music_key);
                        //lekérjük a zene id-t, hogy ez alapján el tudjuk menteni az audiót az audio mappába
                        $mymusics=list_mymusic($user_id);
                        $mymusic_id=$mymusics["music_id"];
                        
                        //áttesszük az audio mappába magát a zenét
                        $uploads="assets/uploads/".$username."/".$track_id."/".$artist." - ".$title; //username - beat_title
                        move_uploaded_file($beat_path, $uploads);

                        $upload_success=true;
                        $_POST=array();
                    }
                }
            }
        }
        /*-----------------------------------------------------------------------------*/
        //cover lekezelése
        if(!isset($_FILES["cover"]) && !is_uploaded_file($_FILES["cover"]["tmp_name"])){
            //ha nincs feltöltve kép, marad az alapértelmezett
            $cover_path= "assets/uploads/cover.jpg";//am nem kéne eltárolni, majd elég megnézni, hogy az adott music id-hoz van-e cover, es ha nincs, berakjuk ezt
        }else{
            //ha tölt fel képet
            $cover_path= $_FILES["cover"]["tmp_name"];

            $fileName = $_FILES["cover"]["name"];
            $fileSize = $_FILES["cover"]["size"];
            $fileError = $_FILES["cover"]["error"];

            $filePart=explode('.',$fileName);//a file nevének tagolása .-tal
            $fileActualExt=strtolower(end($filePart));// . utáni string + kisbetűssé változtatás
    
            $allowed=array('png','jpg','jpeg');//képek formátuma
    
            //kép feldolgozása
            if(in_array($fileActualExt, $allowed)){//ha a file str végén a megengedett típusú formátum van
                if($fileError===0){
                    if($fileSize<31457280){     //30MB = 31457280 byte
                        //$newFileName=uniqid('',true).".".$fileActualExt;//uniqid()=egy véletlenszerű, egyedi string azonosító, kb 23 karakter hosszú

                        $uploads="assets/uploads/".$username."/".$track_id."/".$fileName;
                        move_uploaded_file($cover_path, $uploads);//áthelyezés a $user_picture változóba

                        //change_picture($cover_path, $user_name);
                        $upload_success=true;
                        $_POST=array();//$_POST ürítése
                        //header("Location: profile.php");
                    }else{
                        $errors[]="The file's size is too big";
                    }
                }else{
                    $upload_success=false;
                    $_POST=array();//$_POST ürítése
                    $errors[]="Error during the file's uploading";
                }
            }else{
                $upload_success=false;
                $_POST=array();
                $errors[]="The file's format is not allowed!";
            }
        }
    }
}

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
    <title>Sell your music</title>

    <link rel="stylesheet" href="style/beat.css">
    <link rel="stylesheet" href="style/sell.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
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
            <li><a href="sell.php" class="menus active">Sell your music</a></li>
            <li><a href="contact.php" class="menus">Contact</a></li>
        </ul>
        <?php if (isset($_SESSION["loggedin"])) { ?>
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

<?php if (isset($_SESSION["loggedin"])) { ?>
<form action="sell.php" method="post" enctype="multipart/form-data">
    <label for="title">Beat title</label><br/>
    <input type="text" id="title" name="title"><br/>

    <label for="artist">Artist</label><br/>
    <input type="text" id="artist" name="artist" value="<?php echo $username ?>" ><br/>

    <label for="bpm">BPM</label><br>
    <input type="number" id="bpm" name="bpm"><br/>

    <label for="price">Price</label><br>
    <input type="number" id="price" name="price"><br/>

    <label>Key</label><br/>
    <label>
        <select name="key">
            <option disabled selected>Choose</option>
            <optgroup label="minor">
                <option> Am </option>
                <option> Bm </option>
                <option> Cm </option>
                <option> Dm </option>
                <option> Em </option>
                <option> Fm </option>
                <option> Gm </option>
            </optgroup>
            <optgroup label="major">
                <option> AM </option>
                <option> BM </option>
                <option> CM </option>
                <option> DM </option>
                <option> EM </option>
                <option> FM </option>
                <option> GM </option>
            </optgroup>
        </select>
    </label><br/>

    <label for="cover">Cover image</label><br/>
    <input class="button" type="file" id="cover" name="cover"><br/>

    <label for="beat">Beat</label><br/>
    <input class="button" type="file" id="beat" name="beat"><br/>

    <input name ="submit" class="button" type="submit" value="List my beat">
    <input class="button" type="reset" value="Clear fields"><br/>
</form>
<?php
    if (isset($upload_success) && $upload_success === TRUE) {  // ha nem volt hiba, akkor a regisztráció sikeres
        //echo "<p>Successfully picture uplode!</p>";
    } else {                                // az esetleges hibákat kiírjuk egy-egy bekezdésben
        foreach ($errors as $error) {
        echo "<strong>" . $error . "</strong>"."<br>";
        }
    }
?>
<?php } else { ?>
    <div class="card-holder">
        <div class="log_reg-card">
            <div class="message">
                <strong class="text">Please sign in or register to upload and sell your music!</strong>
            </div>
            <a href="login-register.php"><button type="submit" class="btn">I want to sell my music!</button></a>
        </div>
    </div>
<?php } ?>



<!--footer-->
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



</body>
</html>