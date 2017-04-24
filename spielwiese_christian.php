<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 24.04.2017
 * Time: 15:48
 */

// http://stackoverflow.com/questions/3489017/mysql-php-fetching-data-using-foreign-keys
/*
include_once("userdata.php");

    $db = new PDO($dsn, $dbuser, $dbpass);

$query = <<<QUERY
    SELECT fullname, email 
    FROM user
    INNER JOIN content_txt ON user.userID = post_txt.userID;

QUERY;

$statement = $db->query($query);
$rows = $statement->fetch(PDO::FETCH_ASSOC);
print_r($rows);

$db = null;
*/


include_once("userdata.php");


$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM content_txt WHERE userID = 19";         // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<h1>Tweet Nummer: $zeile->contentID<br></h1>";
    echo "<h2>Benutzername: $zeile->userID<br></h2>";           // Todo: wie komme ich auf den vollen Benutzernamen nicht nur die ID?
    echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
    echo "<h4>$zeile->contentTXT</h4>";
    echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    echo "<a href='show.php?contentID=$zeile->contentID'>zeige</a><br>";
    echo "<a href='update_form.php?id=$zeile->contentID'>editiere</a><br>";
    echo "<a href='delete1.php?id=$zeile->contentID'>l&ouml;sche</a><br>";
    echo "_________________________________________________________";
}