<?php
/**
 * Created by PhpStorm.
 * User: Julia
 * Date: 30.04.2017
 * Time: 10:49
 */

session_start(); //session starten
if($username == "" and $password == ""); //Überprüfung der Login-Daten mit der DB todo

$username = $_POST["username"];
$password = $_POST["password"];
//$userid = $_POST["userid"];

$_SESSION["username"] = $username;
$_SESSION["userid"] = $userid;
?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>

</head>
<body>
    <h1>Einloggen</h1>
    <form action="login_do.php" method="post">
    Benutzername: <input type="text" name="username" /><br>
Passwort: <input type="password" name="password" /><br>
        <input type="submit" value="Einloggen" />
    </form>
</body>
</html>