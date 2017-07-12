<?php include_once ("header.php");?>

<?php


$passwordResetKey = $_GET[passwordKey];

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
<div class="col-md-3 left-element"></div>
<div class="col-md-6 center-element">
<h1>Neues Passwort</h1>
<form action="new_password_do.php" method="post">
    <input type="hidden" name="passwordResetKey" value="<?php echo $passwordResetKey;?>"/>

    <div class="input-group">
        <span class="input-group-addon" >Passwort wiederholen:</span><input id="txtConfirmPassword" type="password" class="form-control" placeholder="Passwort" onChange="checkPasswordMatch();" name="password2" aria-describedby="basic-addon1">
    </div>
    <div class="input-group">
        <span class="input-group-addon">Passwort:</span><input id="txtNewPassword" type="password" class="form-control" placeholder="Passwort" name="password" onChange="checkPasswordMatch();" aria-describedby="basic-addon1">
    </div>

    <br>
    <div class="registrationFormAlert" id="divCheckPasswordMatch"> </div>
    <input disabled  class="btn btn-primary" id="absenden" type="submit" value="Password ändern!" />  <!-- Disabled macht den Button nicht klickbar, wird später per JS aktiviert -->
</form>
</div>
<div class="col-md-3 right-element"></div>
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

