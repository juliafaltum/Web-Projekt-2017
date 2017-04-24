<?php
session_start(); //session starten
if($username == "" and $password == ""); //Überprüfung der Login-Daten mit der DB

$username = $_POST["username"];
$password = $_POST["password"];
//$userid = $_POST["userid"];

$_SESSION["username"] = $username;
$_SESSION["userid"] = $userid;
?>

<html>
<head>
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
Bitte einloggen<br/>
<form method="post" action="index.php?page=log">
    Benutzername: <input type="text" name="username" /> <br/>
    Passwort: <input type="password" name="password" /> <br/>
    <input type="submit" value="Einloggen" /> <br/>

</form>
</body>
</html>

<?php
//auf allen Seiten an erster Stelle:
session_start();
if(!isset($_SESSION["username"])) {
?>

Hier kann alles rein, was auf der jeweiligen Seite angezeigt werden soll.
Dieser Bereich ist geschützt und nur dann zugänglich, wenn man eingeloggt ist!


<?php
}
else {
?>
Bitte <a href="login.html">hier</a> einloggen.
<?php
}
?>
