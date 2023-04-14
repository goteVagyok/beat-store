<?php
    function server_connect(){
        //aatbázis kapcsolat
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "beat-store";

        $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed.");
        if(false==mysqli_select_db($conn, "beat-store")){//adatbázis kiválasztása

            return null;
        }

        mysqli_query($conn, 'SET NAMES UTF8');
        mysqli_query($conn, 'SET character_set_results=utf8');
        mysqli_set_charset($conn, 'utf8');

        return $conn;
    }

    function list_users(){
        if( !($conn=server_connect()) ){
            return false;
        }
        $result=mysqli_query( $conn, "SELECT * FROM users" );

        if(!$result){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $result;
    }

    //ez fölösleges, a SESSION tudja helyettesíteni
    function list_actual_user($username){
        if( !($conn=server_connect()) ){
            return false;
        }
        $stmt=mysqli_prepare( $conn, "SELECT * FROM users WHERE username=?" );

        mysqli_stmt_bind_param($stmt, "s", $username);
        $success=mysqli_stmt_execute($stmt);

        if( $success==false ){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $success;
    }

    function list_mymusic($user_id){

        if( !($conn=server_connect()) ){
            return false;
        }
        $stmt=mysqli_prepare( $conn, "SELECT MUSIC.music_id, MUSIC.title, MUSIC.artist, MUSIC.bpm, MUSIC.price, MUSIC.music_key, MUSIC.user_id FROM music WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "d", $user_id);

        $result=mysqli_stmt_execute($stmt);
        if(!$result){
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_result($stmt, $music_id, $title, $artist, $bpm, $price, $music_key, $u_id);
        $array=array();
        mysqli_stmt_fetch($stmt);
        $array["music_id"]=$music_id;
        $array["title"]=$title;
        $array["artist"]=$artist;
        $array["bpm"]=$bpm;
        $array["price"]=$bpm;
        $array["key"]=$music_key;
        $array["user_id"]=$u_id;
        

        mysqli_close($conn);
        return $array;
    }

    function set_user($username, $password, $email){

        if( !($conn=server_connect()) ){
            return false;
        }
        //id-t kivettem
        $stmt = mysqli_prepare( $conn,"INSERT INTO USERS(username, password, email) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
        $success = mysqli_stmt_execute($stmt);
        mysqli_close($conn);
        return $success;
    }

    function set_music($user_id, $title, $artist, $price, $bpm, $music_key){

        if( !($conn=server_connect()) ){
            return false;
        }
        //id-t kivettem
        $stmt = mysqli_prepare( $conn,"INSERT INTO MUSIC(title, artist, bpm, price, music_key, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssddsd", $title, $artist, $bpm, $price, $music_key, $user_id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_close($conn);
        return $success;
    }

    function change_password($password, $username){

        if(!($conn=server_connect())){
            return false;
        }

        $stmt=mysqli_prepare($conn, "UPDATE USERS SET password=? WHERE username=?");

        mysqli_stmt_bind_param($stmt, "ss", $password, $username);
        $success=mysqli_stmt_execute($stmt);
        if(!$success){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $success;
    }

    function get_user_pic($username){
        //felhaszn.név alapján megkeresi a felhasználó prof. képét, ha nincs null-t ad vissza
        $extensions=array('png','jpg','jpeg');
        $directory="assets/uploads/";

        foreach($extensions as $extension){
            $file=$username.".".$extension;
            $path=$directory.$file;
            //ha talál olyan file-t a mappában, akkor azt visszaadja
            if(file_exists($path)){
                return $path;
            }

        }
        //amúgy meg null-t ad
        return null;
    }

    function get_cover_pics($music_id, $user_id){
        //a két id alapján megkeresi van-e neki borító képe az adott zenéhez, ha nincs null-t ad vissza
        $extensions=array('png','jpg','jpeg');
        $directory="assets/uploads/";

        foreach($extensions as $extension){
            $file=$music_id."-".$user_id.".".$extension;
            $path=$directory.$file;
            //ha talál olyan file-t a mappában, akkor azt visszaadja
            if(file_exists($path)){
                return $path;
            }
        }
        //amúgy meg null-t ad
        return null;
    }

    function fetch_user_data($username): false|array|null
    {
        $query = "select * from users where username = '$username' limit 1";
        $result = mysqli_query(server_connect(), $query);

        if($result && mysqli_num_rows($result) > 0) {

            return mysqli_fetch_assoc($result);

        }
        return null;
    }

?>