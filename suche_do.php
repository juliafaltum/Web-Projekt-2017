<link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>

<h1>
    <?php
    $suchbegriff = $_POST['suchbegriff']; #Suchbegriff aus Formular dem Parameter $suchbegriff zuweisen
    echo "Deine Suchergebnisse für: ". $suchbegriff?>
</h1>


<?php


include_once("userdata.php");

try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE username=$suchbegriff";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        echo "<tr>";
        echo "<td>$zeile->username</td>";

    }

} catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!?..." . $e;
    die();
}

?>

</tbody>
</table>
</br>
<a href="index.php">Zurück zur Startseite</a>

<?php
/**
 * Created by PhpStorm.
 * User: molin
 * Date: 19.06.2017
 * Time: 12:01
 */