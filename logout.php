<?php
	session_start();

	session_unset();						// munkamenet-változók kiürítése
	session_destroy();						// munkamenet törlése

	header("Location: login-register.php");			// átirányítás a login.php oldalra
?>