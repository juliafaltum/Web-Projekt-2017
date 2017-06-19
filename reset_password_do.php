<?php
$email = $_POST['email']; // Email Adresse aus Formular

try {
    include_once ("userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();

    if ($zeile = $query->fetchObject()) {
        $emailVorhanden = 1;

        $userEmail = $zeile->email;
    }
    else {
        $emailVorhanden = 0;
    }
    $db = null;

} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}


if ($emailVorhanden == 1) {             // Wenn Email in der DB vorhanden ist

    $passwordResetKey = rand(1, 213546548268184185461841841).uniqid();

            try {
            include_once("userdata.php");
            $db = new PDO($dsn, $dbuser, $dbpass);
            $query = $db->prepare(
                "UPDATE user SET passwordResetKey = :passwordResetKey WHERE email = :email");
            $query->execute(array("passwordResetKey" => $passwordResetKey, "email" => $email));
            $db = null;
        } catch (PDOException $e) {
            echo "Error: Bitten wenden Sie sich an den Administrator!";
            die();
        }


        // Email absenden

            $empfaenger = $userEmail;
            $betreff = 'Passwort test';
            $nachricht = 'Du hast ein neues Passwort angefragt! Wenn du das nicht warst, kannst du uns unter test@test.de kontaktieren! Hier dein individueller Reset-Key: https://mars.iuk.hdm-stuttgart.de/~cm111/new_password.php?passwordKey='.$passwordResetKey;
            $header = 'From: webmailtest@mars.iuk.hdm-stuttgart.de' . "\r\n" .
                'Reply-To: webmailtest@mars.iuk.hdm-stuttgart.de' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

         mail($empfaenger, $betreff, $nachricht, $header);






}


echo "Wenn Sie einen Account registriert haben bei uns bekommen Sie in wenigen Minuten eine Email an die angegebene Adresse: $email";









