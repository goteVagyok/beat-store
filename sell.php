<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    // ha be van jelentkezve a felhasznalo

    $user = $_SESSION['user'];
    $username = $user['username'];

    $upload_success = false;

    if(isset($_POST["submit"])) {
        $target_dir = getcwd() . "uploads/";
        $target_file = $target_dir . basename($_FILES['beat']['name']);
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($file_type == "mp3" && !file_exists($target_file)) { // mp3 es nem letezik
            $upload_success = true;
        } else {
            /*
            echo "<strong>checkek nem jok</strong>";
            echo "<br>";
            echo "type: ";
            echo $file_type == "mp3";
            echo "<br>";
            echo "exists: ";
            echo !file_exists($target_file);
            echo "<br>";
            */
        }
        if($upload_success) {
             if(move_uploaded_file($_FILES['beat']['name'], $target_file)) {
                 echo "siker";
             } else {
                 echo "baj de nagy";
             }
        }
    }


} else {
    //ha nincs bejelentkezve akkor csak dobja a login oldalra
    header("login.php");
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
    <a href="beat.html" class="logo">BEAT STORE</a>
    <nav class="navbar">
        <ul class="header_menu">
            <li><a href="tracks.html" class="menus">Tracks</a></li>
            <li><a href="licensing.html" class="menus">Licensing</a></li>
            <li><a href="sell.php" class="menus active">Sell your music</a></li>
            <li><a href="contact.html" class="menus">Contact</a></li>
        </ul>
        <div class="connection">
            <a href="login-register.php">Login</a>
            <a href="register.html">Register</a>
        </div>
    </nav>
</header>


<form action="sell.php" method="post" enctype="multipart/form-data">
    <label for="title">Beat title</label><br/>
    <input type="text" id="title" name="title"><br/>

    <label for="artist">Artist</label><br/>
    <input type="text" id="artist" name="artist" value="<?php echo $user['username'] ?>" ><br/>

    <label for="bpm">BPM</label><br>
    <input type="number" id="bpm" name="bpm"><br/>

    <label for="price">Price</label><br>
    <input type="number" id="price" name="price"><br/>

    <label>Key</label><br/>
    <label>
        <select>
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
                    <li><a href="register.html">Register</a></li>
                    <li><a href="login-register.php">Login</a></li>
                    <li><a href="contact.html">Contact us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Social Media</h4>
                <div class="social">
                    <ul>
                        <li><a href="https://www.youtube.com/watch?v=dQw4w9W