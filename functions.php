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

        if( $result==false ){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $result;
    }

    function list_actual_users($username){
        if( !($conn=server_connect()) ){
            return false;
        }
        $stmt=mysqli_prepare( $conn, "SELECT USERS.id, USERS.username, USERS.password, USERS.email, USERS.profile_picture FROM users WHERE username=?" );

        mysqli_stmt_bind_param($stmt, "s", $username);
        $success=mysqli_stmt_execute($stmt);

        if( $success==false ){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $success;
    }

    function list_allmusics(){
        if( !($conn=server_connect()) ){
            return false;
        }
        $result=mysqli_query( $conn, "SELECT MUSIC.title, MUSIC.artist, MUSIC.file_path FROM music LEFT JOiN users ON MUSIC.user_id=USERS.id");

        if( $result==false ){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $result;
    }

    function list_mymusic($user_id){

        if( !($conn=server_connect()) ){
            return false;
        }
        $stmt=mysqli_prepare( $conn, "SELECT MUSIC.title, MUSIC.artist, MUSIC.file_path FROM music WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "d", $user_id);

        $result=mysqli_stmt_execute($stmt);
        if( $result==false ){
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_result($stmt, $title, $artist, $file_path);
        $array=array();
        mysqli_stmt_fetch($stmt);
        $array["title"]=$title;
        $array["artist"]=$title;
        $array["file_path"]=$title;
        

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

    function set_music($user_id, $title, $artist, $file_path){

        if( !($conn=server_connect()) ){
            return false;
        }
        //id-t kivettem
        $stmt = mysqli_prepare( $conn,"INSERT INTO MUSIC(title, artist, file_path, user_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssd", $title, $artist, $file_path, $user_id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_close($conn);
        return $success;
    }

    function change_picture($picture_path, $username){

        if(!($conn=server_connect())){
            return false;
        }

        $stmt=mysqli_prepare($conn, "UPDATE USERS SET profile_picture=? WHERE username=?");

        mysqli_stmt_bind_param($stmt, "ss", $picture_path, $username);
        $success=mysqli_stmt_execute($stmt);
        if($success==false){
            die(mysqli_error($conn));
        }
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
        if($success==false){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $success;
    }

?>