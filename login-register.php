<!----php-login/register---->
<?php
    /*
    //aatbázis kapcsolat
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "beat-store";

    //csatlakozás az adatbázishoz
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //ellenőrzés, hogy sikeres-e a kapcsolat
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    include "functions.php";
    //$users=loadUsers(); //felhasználók lekérdezése
    $errors=[];   //a hibákat egy tömbben tároljuk
    $message="";    //üzenetek

    //regisztrációnál
    if(isset($_POST["register"])){

        if(!isset($_POST["username2"]) || trim($_POST["username2"]) === "")
            $errors[]="The username is required!";

        if(!isset($_POST["email"]) || trim($_POST["email"]) === "")
            $errors[]="The email is required!";

        if(!isset($_POST["password2"]) || trim($_POST["password2"]) === "" || !isset($_POST["password2_confirm"]) || trim($_POST["password2_confirm"]) === "")
            $errors[]="The password is required!";
            
        if(!isset($_POST["agree"]))
            $errors[]="Please check the checkbox!";

        $username2=$_POST["username2"];
        $password2=$_POST["password2"];
        $password2_confirm=$_POST["password2_confirm"];
        $email=$_POST["email"];

        //foglalt-e a felhasználónév vagy email
        foreach($users as $user){
            if($user["username"]===$username2){
                $errors[]="The username is already used.";
            }elseif($user["email"]===$email){
                $errors[]="The email is already used.";
            }
        }

        //jelszó hosszának megszabása
        if(strlen($password2)<6)
            $errors[]="The minimum password length is 6!";

        //a két jelszó egyezése
        if($password2!==$password2_confirm)
            $errors[]="The passwords do not match!";

        //sikeres-e a regisztráció
        if(count($errors)===0){
            //jelszo hashelése
            $password2=password_hash($password2, PASSWORD_DEFAULT);
            //új felhasználó feltöltése az adatbázisba
            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username2, $password2, $email);
            $stmt->execute();
            $success=TRUE;
            header("Location: profile.php");
        }else{
            $success=FALSE;
        }
        
    }elseif(isset($_POST["login"])){
        //ha nincs felhaszn.név és jelszó, vagy ha nem üres stringek
        if(!isset($_POST["username"]) || trim($_POST["username"]) === "" || !isset($_POST["password"]) || trim($_POST["password"]) === ""){
            $errors[]="<strong>Error:</strong> Fill the username and password fields!";
         //ha minden jó
        }else{
            $username=$_POST["username"];
            $password=$_POST["password"];
            $hashed_password=password_hash($password, PASSWORD_DEFAULT);

            if(empty($errors)){
                $sql="SELECT username, password FROM users WHERE username=? AND password=?";
                if($stmt=mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt, "ss", $p_username, $p_password);

                    $p_username=$username;
                    $p_password=$password;

                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_store_result($stmt);

                        //van-e ilyen felhasználónév-jelszó páros
                        if(mysqli_stmt_num_rows($stmt)==1){
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                            if(mysqli_stmt_fetch($stmt)){
                                //ha egyezik a jelszó a tárolt hash jelszóval
                                if(password_verify($password, $hashed_password)){
                                    session_start();

                                    //adatok eltárolása SESSION változókba
                                    $_SESSION["loggedin"]=true;
                                    $_SESSION["id"]=$id;
                                    $_SESSION["username"]=$username;

                                    header("Location: profile.php");
                                }else{
                                    $errors[]="Invalid password!";
                                }
                            }
                        }else{
                            //ha nincs ilyen felhasználó
                            $errors[]="Invalid username";
                        }
                    }else{
                        $errors[]="Something is wrong. Try again!";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            */
/////////////////////////////////////////////////////////////////////////////////
    include "functions.php";
    $result=list_users();
    $users=array();
    //a lekérdezést beletesszük egy asszociatív tömbbe
    while( $row=mysqli_fetch_assoc($result) ){
        $users[]=$row;
    }

    $errors=[];
    $message="";

    if( isset($_POST["register"]) ){

        if(!isset($_POST["username2"]) || trim($_POST["username2"]) === ""){
            $errors[]="The username is required!";
        }

        if(!isset($_POST["email"]) || trim($_POST["email"]) === ""){
            $errors[]="The email is required!";
        }

        if(!isset($_POST["password2"]) || trim($_POST["password2"]) === "" || !isset($_POST["password2_confirm"]) || trim($_POST["password2_confirm"]) === ""){
            $errors[]="The password is required!";
        }
            
        if(!isset($_POST["agree"])){
            $errors[]="Please agree the terms!";
        }
        

        /*
        //olyan random számot választunk, ami nincs még lefoglalva
        $random_num=mt_rand(10000000000, 99999999999);//11 random jegyű id
        for($i=0;$i<count($users);$i++){
            if($users[$i]["id"]===$random_num){
                //mindig kezdje előröl a ciklust, ha talált ilyen id-t
                $random_num=mt_rand(10000000000, 99999999999);
                $i=-1;
            }
        }


        $id=$random_num;
        */
        $username2=$_POST["username2"];
        $password2=$_POST["password2"];
        $password2_confirm=$_POST["password2_confirm"];
        $email=$_POST["email"];


        //foglalt-e a felhasználónév vagy email
        foreach($users as $user){
            if($user["username"]===$username2){
                $errors[]="The username is already used.";
            }elseif($user["email"]===$email){
                $errors[]="The email is already used.";
            }
        }
        //jelszó hosszának megszabása
        if(strlen($password2)<6){
            $errors[]="The minimum password length is 6!";
        }
        //a két jelszó egyezése
        if($password2!==$password2_confirm){
            $errors[]="The passwords do not match!";
        }


        //ha nincs hiba
        if(count($errors)===0){
            //$passw.2 hashelése
            $password2=password_hash($password2, PASSWORD_DEFAULT);
            //felhasználó felvétele
            set_user($username2, $password2, $email);
            $success=true;
            session_start();

            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = fetch_user_data($username2);

            header("Location: profile.php");
            exit();//kell?
        }else{
            $success=false;
            //$_POST=array();//tömb nullázása, hogy ne maradjon benne a rossz adat
            //unset($id);
            //unset($username2);
            //unset($password2);
            //unset($email);
            unset($_POST["username2"]);
            unset($_POST["password2"]);
            unset($_POST["password2_confirm"]);
            unset($_POST["email"]);
            unset($_POST["agree"]);
            unset($_POST["register"]);
            //unset($_POST);
        }
     
    }elseif( isset($_POST["login"]) ){

        if(!isset($_POST["username"]) || trim($_POST["username"]) === "" || !isset($_POST["password"]) || trim($_POST["password"]) === ""){
            $errors[]="<strong>Error:</strong> Fill the username and password fields!";

        }else{

            $username=$_POST["username"];
            $password=$_POST["password"];
            $hashed_password=password_hash($password, PASSWORD_DEFAULT);

            //ha nincs error
            if(empty($errors)){

                foreach($users as $user){
                    if($user["username"]===$username){
                        if(password_verify($password, $user["password"])){

                            session_start();

                            $_SESSION['loggedin'] = true;
                            $_SESSION['user'] = $user;

                            header("Location: profile.php");
                        }else{
                            $message="Invalid password!";
                        }
                    }else{
                        $message="Invalid username!";
                    }
                }
            }
        }
    }





/////////////////////////////////////////////////////////////////////////////////
            /*

            //alapból sikertelenséget várunk
            //$message="You didn't login!";


            //megnézzük, hogy tényleg létezik ilyen felhasználó ezzel a jelszóval

            //a ? helyére megy 
            $sql_check="SELECT username, password FROM users WHERE username=? AND password=?";
            //a ? helyére beteszi a $username változót, az 'ss' pedig azt jelenti, hogy az a kettő egy-egy string lesz
            $stmt=mysqli_prepare($conn,$sql_check);//előkészíti az adatbázis lekérdezését a futtatás előtt
            //a ? helyére beteszi a $username változót, az 's' pedig azt jelenti, hogy az egy string lesz
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
            mysqli_stmt_execute($stmt);//a prepaired statement($stmt) futtatása a paraméterekkel együtt; igaz, ha sikeres, hamis ha nem
            $result_check=mysqli_stmt_get_result($stmt);//kapott eredményhalmaz feldolgozása
            //$result_check=mysqli_query($conn,$sql_check);//ugyan az mint egyel fentebb
            
            //ha van ilyen felhasználó
            if($result_check->num_rows > 0){
                $row = mysqli_fetch_assoc($result_check);//true, ha talál olyan eredményhalmazt, false, ha üres az eredményhalmaz
                //ha talált ilyen jelszót az eredményhalmazban
                if(password_verify($password,$row['password'])){
                    //munkamenet elindítása, ha nincs elindítva, nem lehet elérni a szerver oldalon tárolt munkamenet adatokat
                    session_start();
                    //felhasználó bejelentkeztetése
                    $_SESSION['username']=$username;
                    //profile oldalra átirányítás
                    header("Location: profile.php");
                    exit();
                //ha nincs hozzá jelszó, azaz az helytelen
                }else{
                    $message="<strong style='color:red;'>Warning: There is no same username-password pair.</strong>";
                }
            }
            /*
            //vagy: (de ekkor nincs védelem az SQL injection ellen)
            foreach($users as $user){
                //ha a felhaszn.név-jelszó páros megtalálható az adatok közt
                if($user["username"]===$username && password_verify($password, $user["password"])){
                    $message="Succsessfully login!";
                    header("Location: profile.php");
                }
            }
            */

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
    <link rel="stylesheet" href="style/login-register.css">

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
                <a href="login-register.php" class="active">Login</a>
            </div>
        </nav>
    </header>

    
    
    <!--Login/Register-->
    <div class="card-holder">
        <div class="log_reg-card">

            <div class="form-box login">
                <h2>Login</h2>
                <form action="login-register.php" method="post">
                    <div class="input-box">
                        <input id="nickname" name="username" type="text" required><label for="nickname"> Nickname</label>
                    </div>
                    <div class="input-box">
                        <input id="password" name="password" type="password" required><label for="password"> Password</label>
                    </div>
                    <!--
                    <div class="remember-forgot">
                        <label for="remember-forgot"><input type="checkbox" id="remember-forgot">Remember me</label>
                        <a href="#">Forgot password?</a>
                    </div>
                    -->
                    <button type="submit" name="login" class="btn">Login</button>
                    <div class="login-register">
                        <p>Register if you don't have an account <a href="#" class="register-link">Register</a></p>
                    </div>
                </form>
                <?php echo $message . "<br/>"; 
                    print_r($_POST);
                    if (isset($success) && $success === TRUE) {  // ha nem volt hiba, akkor a regisztráció sikeres
                        echo "<p>Successfully registration!</p>";
                    } else {                                // az esetleges hibákat kiírjuk egy-egy bekezdésben
                        foreach ($errors as $error) {
                        echo "<strong>" . $error . "</strong>";
                        }
                    }
                ?>
            </div>


            <div class="form-box registration">
                <h2>Registration</h2>
                <form action="login-register.php" method="post">
                    <div class="input-box">
                        <input id="nickname2" name="username2" type="text" required><label for="nickname2"> Nickname</label>
                    </div>
                    <div class="input-box">
                        <input id="email" name="email" type="email" required><label for="email"> Email</label>
                    </div>
                    <div class="input-box">
                        <input id="password2" name="password2" type="password" required><label for="password2"> Password</label>
                    </div>
                    <div class="input-box">
                        <input id="password2" name="password2_confirm" type="password" required><label for="password2"> Confirm password</label>
                    </div>
                    <div class="agreement">
                        <label for="agreement"><input type="checkbox" name="agree" id="agreement">I agree the terms and conditions.</label>
                    </div>
                    <button type="submit" name="register" class="btn">Register</button>
                    <div class="login-register">
                        <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script/log_reg.js"></script>
    
</body>
</html>