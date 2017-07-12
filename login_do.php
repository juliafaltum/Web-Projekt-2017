<?php include_once ("res.php");

// Login durchführen

$username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8"); // Benutzername holen aus Formular
$eingabePassword = ($_POST["password"]);    //Passwort holen aus Formular



include_once("userdata.php");


    $db = new PDO($dsn, $dbuser, $dbpass);  // Datenbank initialisieren
    $sql = "SELECT * FROM user WHERE username = :username"; // DB-Bedingungen, nur Passwort zu angegebenen Username wird gesucht
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username);      // Per POST geholter Parameter wird oben an die Stelle von :username gepackt
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        $passwordausDB = $zeile->password;
        $userIDausDB = $zeile->userid;
        $usernameausDB = $zeile->username;
    }


if(password_verify($eingabePassword, $passwordausDB)) {     // Funktion password_verify macht Gegenteil von password_hash --> Nun wird Nutzereingabe ($eingabePassword) mit Datenbank Hash-Wert ($passwordausDB) verglichen

    session_start();
    $_SESSION["username"] = $usernameausDB;
    $_SESSION["userid"] = $userIDausDB;
    header ('Location: index.php');

} else {
    header("Location: login.php?notification=loginFailed");

}

