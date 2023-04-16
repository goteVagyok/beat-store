<?php
    function server_connect(){
        //aatbázis kapcsolat
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "beat-store";

        $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed.");
        if(!mysqli_select_db($conn, "beat-store")){//adatbázis kiválasztása

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
        $stmt=mysqli_prepare( $conn, "SELECT * FROM music WHERE user_id=?");
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

    function list_mymusic_by_music_id($music_id){
        //listáz egy zenét music_id alapján
        if( !($conn=server_connect()) ){
            return false;
        }
        $stmt=mysqli_prepare( $conn, "SELECT * FROM music WHERE music_id=?");
        mysqli_stmt_bind_param($stmt, "d", $music_id);

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

    function get_n_of_uploads_by($username): int {
        //megmondja hany mappa van a felhasznalo mappajaban (hany tracket toltott fel)
        $dirs = scandir("assets/uploads/".$username."/");
        return count($dirs);
    }

    function get_cover_pic($username, $track_id): string {
        $beat_folder = "assets/uploads/".$username."/".$track_id."/";
        //pl.: assets/uploads/username/0/

        $allowed=array('png','jpg','jpeg');

        foreach (scandir($beat_folder) as $file) {
            if (in_array(pathinfo($file)['extension'], $allowed)) {
                //ha talalunk a mappaban kepet akkor az a cover es returnoljuk egybol
                return $beat_folder.$file;
            }
        }
        //ha nem talaltunk a mappaban kepet akkor a defaultot adjuk vissza
        return "assets/uploads/cover.jpg";
    }

    function get_beat($username, $track_id): string|null {
        $beat_folder = "assets/uploads/".$username."/".$track_id."/";
        //pl.: assets/uploads/username/0/

        $allowed=array('mp3');

        foreach (scandir($beat_folder) as $file) {
            if (in_array(pathinfo($file)['extension'], $allowed)) {
                //ha talalunk a mappaban zenet akkor az a beat es returnoljuk egybol
                return $beat_folder.$file;
            }
        }
        //ha nem talaltunk a mappaban zenet akkor kurva nagy baj van xd
        return null;
    }

    function set_user($username, $password, $email){

        if( !($conn=server_connect()) ){
            return false;
        }
        
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

    function list_user_beats($user_music, $username){
        //kilistázza az adott user zenéit képekkel együtt

        //ha nincs zenéje a user-nek, akkor null-t ad vissza
        if(count($user_music)==0){
            return null;
        }

        $beats=array();
        $covers=array();
        
        $i=1;//mappák indexelésére(1-től addig ahány mappa van az adott user-nek)
        $k=0;//tömb indexelésére
        while($i<=count($user_music)){

            //sorban eltároljuk a zenék adatait
            $beats[$k]=get_beat($username, $i);
            $covers[$k]=get_cover_pic($username,$i);

            $k++;
            $i++;
        }
        $uploads=[$beats, $covers]; //két asszociatív tömböt foglal magába
        return $uploads;
    }

function deleteDir($dirPath): void {
        //kollaboralnom kellett stackoverflowal az elmem epsege megorzese vegett
        //https://stackoverflow.com/a/3349792
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (!str_ends_with($dirPath, '/')) {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

    function delte_user($user_id){
        
        if( !($conn=server_connect()) ){
            return false;
        }

        $user_folder = "assets/uploads/".$_SESSION['user']['username'];

        if(file_exists($user_folder)) {
            deleteDir($user_folder);
        }
            /*    //user mappaja torlese
                for($i = 1; $i < get_n_of_uploads_by($_SESSION['user']['username']) - 1; $i++) {
                    foreach (scandir($user_folder."/".$i) as $dir) {
                        foreach (scandir($user_folder."/".$i."/".$dir) as $f) {
                            unlink($user_folder.$i.$dir.$f);
                            //faszert nem lehet teli mappakat is torolni kurva eletbe mar
                        }
                        rmdir($user_folder.$i.$dir);
                    }
                    rmdir($user_folder.$i);
                }
                rmdir($user_folder);
            en megprobaltam
            */

        $extensions = ['.jpg', '.jpeg', '.png'];
        foreach ($extensions as $ext) {
            //user profilkepe torlese (ha van)
            if (file_exists($user_folder.$ext)) {
                unlink($user_folder.$ext);
            }
        }

        $stmt = mysqli_prepare( $conn,"DELETE FROM USERS WHERE id=?");
        mysqli_stmt_bind_param($stmt, "d", $user_id);
        $success = mysqli_stmt_execute($stmt);

        if ( $success == false ) {
            die(mysqli_error($conn));
        } 
        mysqli_close($conn);
        return $success;

    }

?>