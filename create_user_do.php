<?php include_once ("res.php");

// Nutzer wird erstellt mit vorhandenen Daten aus Formular, Fehlermeldung bei fehlenden Angaben

// Formular daten per Post holen
$userid = $_SESSION ['userid'];
$username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
$fullname = htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8");
$email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
$Birthdate = date("Y-m-d", strtotime($_POST["birthdate"]));         // Quelle: https://stackoverflow.com/questions/20132834/take-date-from-html5-form-and-post-to-mysql
$gender = $_POST["gender"];


// Passwort Hashing
$NOHASHpassword = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
$password = password_hash($NOHASHpassword, PASSWORD_DEFAULT);

$Kontrollepassword = $_POST["password"];
$Kontrollepassword2 = $_POST["password2"];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {            // Quelle: http://php.net/manual/de/filter.examples.validation.php
    $emailVerifiziert = 1;
}

// username doppelt?

try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE username = :username";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        $usernameDoppelt = 1;

    }

    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}


try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $query = $db->prepare(
        "SELECT * FROM user WHERE email = :email)");
    $query->execute(array("email" => $email));

    while ($zeile = $query->fetchObject()) {

        $emailDoppelt = 1;
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

// Passwort stimmen überein?


// File-Upload; Nur wenn Bild gesetzt ist, Wert in die DB schreiben!
if (file_exists($_FILES['fileToUpload']['tmp_name'])){

    include_once("Upload_do.php");
}
else {
    $uploadfile = 0;
}



// Kontrolle
if (isset($usernameDoppelt)) {
    header( "refresh:5;url=index.php" );
    echo "Dieser Benutzername existiert bereits. Wähle einen anderen Benutzername. Dur wirst in 5 Sekunden zurück auf die Regestrieren Seite geleitet.";
}

elseif (isset($emailDoppelt)) {
    header( "refresh:5;url=index.php" );
    echo "Diese Email existiert bereits. Wähle einen andere Email. Dur wirst in 5 Sekunden zurück auf die Regestrieren Seite geleitet.";
}

elseif ($Kontrollepassword != $Kontrollepassword2) {
    header( "refresh:5;url=index.php" );
    echo "Die Passwörter stimmen nicht überein! Dur wirst in 5 Sekunden zurück auf die Regestrieren Seite geleitet.";
}

elseif (empty($emailVerifiziert)) {
    header( "refresh:5;url=index.php" );
    echo "Dies ist keine gültige Email-Adresse. Dur wirst in 5 Sekunden zurück auf die Regestrieren Seite geleitet.";
}

else {

    if (isset($username) && isset($fullname) && isset($email))  {

        try {
            $db = new PDO($dsn, $dbuser, $dbpass);
            $query = $db->prepare(
                "INSERT INTO user (username, fullname, email, password, usercreated, profilePicture, Birthdate, gender ) VALUES(:username, :fullname, :email, :password, NOW(), :profilePicture, :Birthdate, :gender)");
            $query->execute(array("username" => $username, "fullname" => $fullname, "email" => $email, "password" => $password, "profilePicture" => $uploadfile, "Birthdate" => $Birthdate, "gender"=> $gender ));
            $db = null;
        } catch (PDOException $e) {
            echo "Error!: Bitten wenden Sie sich an den Administrator...";
            die();
        }
        header('Location: create_user_done.php');

    }
    else {
        echo "Es ist ein Fehler bei der Datenverarbeitung aufgetreten. Wenden Sie  bitte an den Admin.<br/>";
    }

}



