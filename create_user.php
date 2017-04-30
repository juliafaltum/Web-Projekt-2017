<?php
/**
 * Created by PhpStorm.
 * User: Julia
 * Date: 30.04.2017
 * Time: 11:17
 */
if(!isset($_GET["page"])) {
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<body>
    <h1>Neuer Benutzer</h1>
    <form action="create_user_do.php" method="post">
    Benutzername: <input type="text" name="username" /><br>
    Voller Name: <input type="text" name="fullname" /><br>
    Email Adresse: <input type="text" name="email" /><br>
    Passwort: <input type="password" name="password" /><br>
    Passwort wiederholen: <input type="password" name="password2" /><br>
    <input type="submit" value="Benutzer erstellen" />
    </form>
</body>
</html>

