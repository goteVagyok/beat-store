<?php
    session_start();
    if (!isset($_SESSION["loggedin"])) {
        header("Location: login-register.php");
    }
    include "functions.php";

    $picture_errors=[];
    $password_errors=[];

    $user_picture=$_SESSION["user_pic"];
    $user_id=$_SESSION["user"]["id"];
    $user_name=$_SESSION["user"]["username"];

    if( isset($_POST["picture"]) ){

        if(!isset($_FILES["file"])){
            $picture_errors[]="Choose a picture";
        }

        //$file=$_FILES["file"];
        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];//a kép elérési útvonala + az ideiglenes neve
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];
        //$fileType = $_FILES["file"]["type"];


        $filePart=explode('.',$fileName);//a file nevének tagolása .-tal
        $fileActualExt=strtolower(end($filePart));// . utáni string + kisbetűssé változtatás

        $allowed=array('png','jpg','jpeg');//képek formátuma

        //kép feldolgozása
        if(in_array($fileActualExt, $allowed)){//ha a file str végén a megengedett típusú formátum van
            if(count($picture_errors)===0 && $fileError===0){
                if($fileSize<31457280){     //30MB = 31457280 byte
                    //$newFileName=uniqid('',true).".".$fileActualExt;//uniqid()=egy véletlenszerű, egyedi string azonosító, kb 23 karakter hosszú

                    $user_picture="assets/uploads/".$user_name.".".$fileActualExt;
                    move_uploaded_file($fileTmpName, $user_picture);//áthelyezés a $user_picture változóba
                    $_SESSION["user_pic"]=$user_picture;

                    $success=true;
                    $_POST=array();//$_POST ürítése
                    header("Location: profile.php");
                }else{
                    $picture_errors[]="The file's size is too big";
                }
            }else{
                $success=false;
                $_POST=array();//$_POST ürítése
                $picture_errors[]="Error during the file's uploading";
            }
        }else{
            $success=false;
            $_POST=array();
            $picture_errors[]="The file's format is not allowed!";
        }
        

    }elseif( isset($_POST["password"]) ){

        if(!isset($_POST["password1"]) || trim($_POST["password1"]) === "" || !isset($_POST["password2"]) || trim($_POST["password2"]) === ""){
            $password_errors[]="The password is required!";
        }

        $password1=$_POST["password1"];
        $password2=$_POST["password2"];

        //jelszó hosszának megszabása
        if(strlen($password1)<6){
            $password_errors[]="The minimum password length is 6!";
        }
        //a két jelszó egyezése
        if($password1!==$password2){
            $password_errors[]="The passwords do not match!";
        }

        if(count($password_errors)===0){
            //$passw hashelése
            $password1=password_hash($password1, PASSWORD_DEFAULT);
            //jelsuó módosítása
            change_password($password1, $user_name);
            $success=true;
            $_POST=array();//$_POST ürítése
            header("Location: profile.php");
        }else{
            $success=false;
            $_POST=array();//$_POST ürítése
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
    <link rel="stylesheet" href="style/editdata.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


</head>
<!--valamiért css-ben nem működik a background-->
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
            <div>
                <a href="profile.php"><img class="profile-picture" src="<?php echo "$user_picture" ?>" alt="profile_picture"></a>
            </div>
        </nav>
    </header>
    
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
                    <li><a href="mymusic.php">My musics</a></li>
                    <hr>
                    <li><a class="active" href="editdata.php">Edit data</a></li>   <!--change password|edit profile picture-->
                    <hr>
                </ul>
            </div>
            <!--adatok, a menü alapján-->
            <div class="profile-data">
                <div class="datas">
                    <div>
                        <h2>Change profile picture</h2>
                        <form action="editdata.php" method="post" enctype="multipart/form-data">
                            <img class="profile-picture" src="<?php echo "$user_picture" ?>" alt="profile_picture">
                            <br>
                            <input type="file" name="file">
                            <button type="submit" class="btn" name="picture">Change picture</button>
                        </form>
                        <?php
                            if (isset($success) && $success === TRUE) {  // ha nem volt hiba, akkor a regisztráció sikeres
                                //echo "<p>Successfully picture uplode!</p>";
                            } else {                                // az esetleges hibákat kiírjuk egy-egy bekezdésben
                                foreach ($picture_errors as $error) {
                                echo "<strong>" . $error . "</strong>"."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="change-password">
                        <h2>Change password</h2>
                        <form action="editdata.php" method="post">
                            <div class="input-box">
                                <input id="password2" type="password" name="password1" required><label for="password2"> Password</label>
                            </div>
                            <div class="input-box">
                                <input id="password2" type="password" name="password2" required><label for="password2"> Confirm pswd</label>
                            </div>
                            <button type="submit" class="btn" name="password">Change password</button>
                        </form>
                        <?php
                            if (isset($success) && $success === TRUE) {  // ha nem volt hiba, akkor a regisztráció sikeres
                                //echo "<p>Successfully password changing!</p>";
                            } else {                                // az esetleges hibákat kiírjuk egy-egy bekezdésben
                                foreach ($password_errors as $error) {
                                echo "<strong>" . $error . "</strong>"."<br>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <img class="waves-picture" src="assets/img/waves.png" alt="waves_picture">
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