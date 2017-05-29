<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 26.05.2017
 * Time: 15:37
 */

function showContent () {               //TODO: Wird noch nicht verwendet, ermöglicht anzeigen der Tweets! --> Später verwende, damit es einheitlich ist.
try {
    global $dsn, $dbuser, $dbpass;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {

        echo "<h2>Tweet Nummer: $zeile->contentID<br></h2>";
        echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
        echo "<h3>Geschrieben von: <a href='profil.php?userid=$zeile->userid'>$zeile->username</a><br>";



        followButton ($_SESSION['userid'], $zeile->userid);          // FUNKTION: Follow-Button



        echo "<h4>$zeile->contentTXT</h4>";
        echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
        echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
        echo "<a href='show.php?contentID=$zeile->contentID'>zeige</a><br>";

        contentPoints($zeile->contentID);      // FUNKTION: Punkte berechnen des Posts


        if($_SESSION['userid']==$zeile->userID) {
            echo "Du bist Autor dieses Posts, also kannst du folgendes machen: <br>";
            echo "<a href='edit.php?contentID=$zeile->contentID'>editieren</a><br>";
            echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;sche</a><br>";
        }
        echo "_________________________________________________________";
    }

    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!...".$e;
    die();
}




}

function contentPoints ($contentID) {           // Punkte berechnen von Einträgen

    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT SUM(ratingValue) AS contentPoints FROM rating WHERE contentID = :contentID";
        $query = $db->prepare($sql);
        $query->bindParam(':contentID', $contentID);
        $query->execute();

        if ($zeile = $query->fetchObject()) {
            $summe = $zeile->contentPoints;

            if ($summe == 0) {
                echo "0";
            } else {
                echo $summe;
            }
        }
    }

catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!...".$e;
    die();
}

}




function followButton ($user, $follower) {       // Follow-Button

if (($user != $follower) && (!empty($user))) {       // überprüfen ob man selbst Autor des Tweets ist & eingeloggt ist, wenn ja ab zur else unten

    global $dsn, $dbuser, $dbpass;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM followerlist WHERE user = :user AND follower = :follower";
    $query = $db->prepare($sql);
    $query->bindParam(':user', $user);
    $query->bindParam(':follower', $follower);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        $folgt = 1;

    }

    if ($folgt == 1) {
        echo "<a href='unfollow_do.php?entfolgeuser=$follower'>(Entfolgen)</a>";
    } else {
        echo "<a href='follower_do.php?user=$follower'>(Folgen)</a>";
    }

}
else {
    // Es wird kein Follow Knopf angezeigt
}
}