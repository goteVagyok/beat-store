to-do:
Login:Forgot password -> linket adni neki a contact-re minden html/php oldalon
Minden oldalon -> Register oldal törlése, kivétele a navbar-ból + Login pulzálása css-ben
login.php -> login-register.php átírás minden oldalon
footer -> About us helyére licensing.html, Merch, Pricing helyére mást, vagy törölni
sell your music oldal -> csak bejelentkezés után lehessen látni


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
  profile_picture VARCHAR(255) DEFAULT 'assets\img\profile_picture'
);
CREATE TABLE music (
    music_id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (music_id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
----------