<?php include_once ("header.php");?>

<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 13.06.2017
 * Time: 23:18
 */

$passwordResetKey = $_GET[passwordKey];     // soll als zusätzliches Sicherheitselement auch noch nach der Emnail gefragt werden? --> Todo

try {
    include_once ("userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE passwordResetKey = :passwordResetKey";
    $query = $db->prepare($sql);
    $query->bindParam(':passwordResetKey', $passwordResetKey);
    $query->execute();

    if ($zeile = $query->fetchObject()) {
        ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="js/passwordcheck.js" data-no-instant></script> <!-- Passwort überprüfen mit Javascript, dazu braucht man das oben eingebundene JQuery-->
</head>
<body>
<h1>Neues Passwort</h1>
<form action="new_password_do.php" method="post">
    <input type="hidden" name="passwordResetKey" value="<?php echo $passwordResetKey;?>"/>
    Passwort: <input type="password" name="password" id="txtNewPassword" /><br>
    Passwort wiederholen: <input type="password" id="txtConfirmPassword" onChange="checkPasswordMatch();" name="password2" /><br>
    <br>
    <div class="registrationFormAlert" id="divCheckPasswordMatch">        </div>
    <input disabled type="submit" value="Password ändern!" />  <!-- Disabled macht den Button nicht klickbar, wird später per JS aktiviert -->
</form>
</body>
</html>
        <?php
    }
    else {
        echo "Ungültiger Password Reset Key!";
    }
    $db = null;

} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

