<?php include_once ("header.php");?>
<?php
include_once("session_check.php");
?>


<h1>
    <?php
    $suchbegriff = $_POST['suchbegriff']; #Suchbegriff aus Formular dem Parameter $suchbegriff zuweisen
    echo "Deine Suchergebnisse für: ". $suchbegriff?>
</h1>

<?php


include_once("userdata.php");

try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE username LIKE '%$suchbegriff%'";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        echo "<tr>";
        echo "<a href=\"profil.php?userid=$zeile->userid\"><td>$zeile->username</td></a><br>";

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