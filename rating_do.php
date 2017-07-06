<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 24.05.2017
 * Time: 13:05
 */
include_once("userdata.php");

include_once("session_check.php");

$userID = $_SESSION['userid'];
$contentID = $_POST ['contentID'];
$wertung = $_POST ['wertung'];

if ($wertung == 1) {        // positiv->1
    $WertinDBsoll = 1;
} elseif ($wertung == 2) {      // negativ->2
    $WertinDBsoll = -1;
} elseif ($wertung == 3) { // delete ->3
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "DELETE FROM rating WHERE contentID=$contentID AND userID=$userID";
        $db->prepare($sql)->execute();
        $db = null;
        echo "success";
    } catch (PDOException $e) {
        echo "Error!: Bitten wenden Sie sich an den Administrator...";
        die();
    }


}

// Überprüfen ob schon gevotet



$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM rating WHERE contentID=$contentID AND userID=$userID";
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    $WertinDB = $zeile->ratingValue;
    $userIDinDB = $zeile->userID;
    $schonBewertet = 1;
}
else {
    $schonBewertet = 0;

}
$db = null;




if (($WertinDBsoll == $WertinDB) && $WertinDBsoll == 1) {        // Nutzer drückt erneut auf positiv, obwohl schon positiv bewertet
    echo "Du hast schon positiv bewertet";

} else if (($WertinDBsoll == $WertinDB) && $WertinDBsoll == -1) {           // Nutzer drückt erneut auf negativ, obwohl schon negativ bewertet
    echo "Du hast schon negativ bewertet";

} else if  ($schonBewertet == 0) {           // Noch nicht bewertet, also Wert in DB schreiben
    if (!empty($contentID) && !empty($WertinDBsoll)) {
        include_once("userdata.php");
        try {
            $db = new PDO($dsn, $dbuser, $dbpass);
            $query = $db->prepare(
                "INSERT INTO rating (contentID, userID, ratingValue) VALUES(:contentID, :userID, :ratingValue)");
            $query->execute(array("contentID" => $contentID, "userID" => $userID, "ratingValue" => $WertinDBsoll));
            $db = null;

            echo "success";
        } catch (PDOException $e) {
            echo "Error!: Bitten wenden Sie sich an den Administrator...";
            die();
        }

    }

} else if ($schonBewertet == 1){                // Aktualisieren wenn schon Bewertung vorhanden
    if (!empty($contentID) && !empty($WertinDBsoll)) {
        try {
            include_once("userdata.php");
            $db = new PDO($dsn, $dbuser, $dbpass);
            $query = $db->prepare(
                "UPDATE rating SET ratingValue = :ratingValue WHERE contentID = :contentID AND userID = :userID ");
            $query->execute(array("ratingValue" => $WertinDBsoll, "contentID" => $contentID, "userID" => $userID));
            $db = null;

            echo "success";
        } catch (PDOException $e) {
            echo "Error: Bitten wenden Sie sich an den Administrator!";
            die();
        }
    } else {
        echo "Error: Bitte alle Felder ausfüllen!";

    }
}