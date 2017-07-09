<?php include_once ("header.php");?>
<?php
include_once("session_check.php");
?>

    <?php
echo "<div class='col-md-3 left-element'></div>";
echo "<div class='col-md-6 center-element'>";
    $suchbegriff = $_POST['suchbegriff']; #Suchbegriff aus Formular dem Parameter $suchbegriff zuweisen
    echo "<h3>Deine Suchergebnisse für: $suchbegriff</h3>"?>


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

<div style="text-align: right"><a href="index.php" class='btn btn-primary' type='submit'><i class="fa fa-chevron-left" aria-hidden="true"></i>Zurück</a></div>

</div>
<div class='col-md-3 right-element'></div>