<?php // Login durchführen

$username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8"); // Benutzername holen aus Formular
$eingabePassword = ($_POST["password"]);    //Passwort holen aus Formular



include_once("userdata.php");


    $db = new PDO($dsn, $dbuser, $dbpass);  // Datenbank initialisieren
    $sql = "SELECT * FROM user WHERE username = :username"; // DB-Bedingungen, nur Passwort zu angegebenen Username wird gesucht
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username);      // Per POST geholter Parameter wird oben an die Stelle von :username gepackt
    $query->execute();

    while ($zeile = $query->fetchObject()) {        // Sehr unsaubere Methode mit while Schleife --> Todo
        $passwordausDB = $zeile->password;
    }


if(password_verify($eingabePassword, $passwordausDB)) {     // Funktion password_verify macht Gegenteil von password_hash --> Nun wird Nutzereingabe ($eingabePassword) mit Datenbank Hash-Wert ($passwordausDB) verglichen
    echo "Erfolgreich angemeldet!";     // Bei korrekter eingabe kann z.B. Session gesetzt werden --> Todo
} else {
    echo "Login fehlgeschlagen";        //Bei falscher Eingabe --> Todo
}