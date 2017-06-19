<?php


$passwordResetKey = $_POST[passwordResetKey];

$Kontrollepassword = $_POST["password"];
$Kontrollepassword2 = $_POST["password2"];

$NOHASHpassword = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
$password = password_hash($NOHASHpassword, PASSWORD_DEFAULT);

if ($Kontrollepassword != $Kontrollepassword2) {
    echo "Die Passwörter stimmen nicht überein!";
    die();
}



if (!empty($Kontrollepassword) && !empty($passwordResetKey)) {      // Wenn Nicht leer ist, dann suche in DB nach dem Reset Key und schreibe das neue Passwort aus dem Formular
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE user SET password = :password WHERE passwordResetKey = :passwordResetKey");
        $query->execute(array("password" => $password, "passwordResetKey" => $passwordResetKey));
        $db = null;


        echo "Password erfolgreich geändert!";

        $keylöschen = 1;        // Siehe unten geht es weiter

    } catch (PDOException $e) {
        echo "Error: Bitten wenden Sie sich an den Administrator!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";

}

if ($keylöschen == 1) {         // Password Reset rauslöschen --> Sonst kann mit einem Key das Passwort öfters geändert werden

    $passwordResetKeyDropped = "";
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE user SET passwordResetKey = :passwordResetKeyDropped WHERE passwordResetKey = :passwordResetKey");
        $query->execute(array("passwordResetKey" => $passwordResetKey, "passwordResetKeyDropped" => $passwordResetKeyDropped));
        $db = null;



    } catch (PDOException $e) {
        echo "Error: Bitten wenden Sie sich an den Administrator!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";

}