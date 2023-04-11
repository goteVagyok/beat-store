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
    <link rel="stylesheet" href="style/register-login.css">

</head>
<!--valamiért css-ben nem működik a background-->
<body style="background: url(assets/img/background4.jpg) no-repeat;
             background-size: cover;
             background-position: left;">
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
                <li><a href="sell.php" class="menus">Sell your music</a></li>
                <li><a href="contact.html" class="menus">Contact</a></li>
            </ul>
            <div class="connection">
                <a href="login-register.php">Login</a>
                <a href="register.html" class="active">Register</a>
            </div>
        </nav>
    </header>

    <!----php---->
    <?php
        //aatbázis kapcsolat
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "beat-store";

        //connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        //ellenőrzés, hogy sikeres-e a kapcsolat
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Űrlap adatok ellenőrzése és az adatbázisba való mentése
        if (isset($_POST['submit'])) {//ha rányomott a gombra
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);//ez egy titkosítási fgv, a PASSW... egy konstans, és mindig az aktuális algoritmus kerül használatra a jelszó titkosításához
            
            //megnézzük, hogy a felhasználónév, email már létezik-e az adatbázisban
            $sql_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $result_check = $conn->query($sql_check);//lekérdezési szöveg alapján keresi meg az adatbázisban

            //ha min egy ilyen volt már, akkor hibaüzenet
            if ($result_check->num_rows > 0) {
                echo "<p style='color:red;'>Hiba: a felhasználónév vagy az email cím már használatban van.</p>";
            } else {
                // Új felhasználó beszúrása az adatbázisba
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

                if ($conn->query($sql) === TRUE) {
                    // Sikeres regisztráció, átirányítás a sikeres oldalra
                    header("Location: sikeres_regisztracio.html");
                    exit();
                } else {
                    echo "Hiba: " . $sql . "<br>" . $conn->error;
                }
            }

            // Adatbázis kapcsolat bezárása
            $conn->close();
        }
    ?>

    <!--Login/Register-->
    <div class="card-holder">
        <div class="log_reg-card">

            <div class="form-box registration">
                <h2>Registration</h2>
                <form action="#">
                    <div class="input-box">
                        <input id="nickname2" type="text" required><label for="nickname2"> Nickname</label>
                    </div>
                    <div class="input-box">
                        <input id="email" type="email" required><label for="email"> Email</label>
                    </div>
                    <div class="input-box">
                        <input id="password2" type="password" required><label for="password2"> Password</label>
                    </div>
                    <div class="input-box">
                        <input id="password2" type="password" required><label for="password2"> Confirm password</label>
                    </div>
                    <div class="agreement">
                        <label for="agreement"><input type="checkbox" id="agreement">I agree the terms and conditions.</label>
                    </div>
                    <button type="submit" class="btn">Register</button>
                    <div class="login-register">
                        <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                    </div>
                </form>
            </div>

            <div class="form-box login">
                <h2>Login</h2>
                <form action="#">
                    <div class="input-box">
                        <input id="nickname" type="text" required><label for="nickname"> Nickname</label>
                    </div>
                    <div class="input-box">
                        <input id="password" type="password" required><label for="password"> Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label for="remember-forgot"><input type="checkbox" id="remember-forgot">Remember me</label>
                        <a href="#">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <div class="login-register">
                        <p>Register if you don't have an account <a href="#" class="register-link">Register</a></p>
                    </div>
                </form>
            </div>        
        </div>
    </div>
    <script src="script/reg_log.js"></script>
</body>
</html>