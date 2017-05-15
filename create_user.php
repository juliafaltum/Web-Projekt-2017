<?php
/**
 * Created by PhpStorm.
 * User: Julia
 * Date: 30.04.2017
 * Time: 11:17
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" data-no-instant></script>
    <script src="js/passwordcheck.js" data-no-instant></script> <!-- Passwort überprüfen mit Javascript, dazu braucht man das oben eingebundene JQuery-->
</head>
<body>
    <h1>Neuer Benutzer</h1>
    <form action="create_user_do.php" method="post">
    Benutzername: <input type="text" name="username" /><br>
    Voller Name: <input type="text" name="fullname" /><br>
    Email Adresse: <input type="text" name="email" /><br>
    Passwort: <input type="password" name="password" id="txtNewPassword" /><br>
    Passwort wiederholen: <input type="password" id="txtConfirmPassword" onChange="checkPasswordMatch();" name="password2" /><br>
    <br>
    <div class="registrationFormAlert" id="divCheckPasswordMatch">        </div>
    <input disabled type="submit" value="Benutzer erstellen" />  <!-- Disabled macht den Button nicht klickbar, wird später per JS aktiviert -->
    </form>
</body>
</html>
