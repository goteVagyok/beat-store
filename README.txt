to-do:
---------------
EZ EGYELŐRE TÁRGYTALAN: Login:Forgot password -> linket adni neki a contact-re minden html/php oldalon ---> vagy inlább legyen egy logout a profile.php-n
footer -> About us helyére licensing.php, Merch, Pricing helyére mást, vagy törölni, login.html útvonalat átírni a login-register.php-ra

adatbázisban és a lekérdezésekben -> a music tábla key oszlopa music_key lett!


--------------------------------------------
MySQL adatbázist létrehozó scriptek:
Ahhoz, hogy megnézd milyen a weblap, tedd a mappát a xampp htdocs mappájába, és localhost/beat-store/-ban tudod megnyitni az adott html-és php oldalakat
egyéb tipp:érdemes a php kódot teljesen a html kód felé írni
XAMP megnyistása->apache,mysql indítása->localhost->phpmyadmin->bal oldalt:'Új' (tábla létrehozása)->felül:SQL->
-----------
->
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  role ENUM('user', 'admin') DEFAULT 'user',
  profile_picture VARCHAR(255) DEFAULT 'assets/img/profile_picture.png'
);
CREATE TABLE music (
    music_id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    bpm INT DEFAULT NULL,
    price INT DEFAULT NULL,
    music_key VARCHAR(20) DEFAULT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (music_id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
----------