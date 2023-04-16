to-do:
---------------
EZ EGYELŐRE TÁRGYTALAN: Login:Forgot password -> linket adni neki a contact-re minden html/php oldalon ---> vagy inlább legyen egy logout a profile.php-n
footer -> About us helyére licensing.php, Merch, Pricing helyére mást, vagy törölni, login.html útvonalat átírni a login-register.php-ra

adatbázisban és a lekérdezésekben -> a music tábla key oszlopa music_key lett!

'audio_play<?php echo $i ?>' -> így kéne: "$i" vagy így: $i => jó simán így: $i

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
  role ENUM('user', 'admin') DEFAULT 'user'
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
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
----------

Ezek a meg nem kesz kovetelmenyek, tobbi tudtommal megvan



[ ] legalabb 5 szabvanyos oldal (max 1 nem szabvanyos) (kovetelmeny!)


[ ]  Az oldalon nincsenek hibák: nem jelennek meg warningok, notice-ok, vagy egyéb rosszul
    beállított elemek (pl. img tag, érvénytelen képpel), minden ott lévő funkció működik (0/3 pont)

[ ] Az űrlapok intuitívak, és a felhasználó számára jelezve van, hogy mi a követelmény az
    adott input mezőre nézve (pl. a jelszó legalább 8 karakter), ezek nem az űrlap elküldése
    után jutnak a felhasználó tudtára (0/3 pont)

[ ] Sutik ertelmes hasznalata (0/3 pont)

[ ] objekzumorientaltsag(0/2/4 pont)


Regisztracio
[ ]  Minden kötelezően kitöltendő űrlapmező kitöltése szerveroldalon is ellenőrizve van


Login
[ ]  A felhasználó tudja törölni a felhasználói fiókját, ilyenkor az összes adata törlődik (0/4 pont)                                                                                        pont)

[ ] A felhasználó meg tudja tekinteni más felhasználók profilját / publikus adatait (pl. fel-
    használónév, profilkép, leírás, stb.), továbbá beállítható, hogy milyen adatokat szeretnénk
    publikusan elérhetővé tenni (0/4/8 pont)

[ ]  A felhasználó tud üzenetet küldeni a többi felhasználónak (vagy néhány felhasználónak),
    akik ezt láthatják, és válaszolni tudnak neki (0/4/8 pont)

[ ]  Meg vannak valósítva különböző jogosultsági szintek (pl. felhasználó, admin). Az egyes
    jogosultsági szinttel rendelkező felhasználók több funkciót elérnek (pl. az admin tud
    letiltani felhasználókat, látja a rendeléseket, stb.) (0/4/8 pont)
