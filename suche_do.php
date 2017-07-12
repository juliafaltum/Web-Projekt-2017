<?php include_once ("header.php");?>
<?php
include_once("session_check.php");
?>

<div class='col-md-6 center-element'>
    <?php
    $suchbegriff = $_POST['suchbegriff']; #Suchbegriff aus Formular dem Parameter $suchbegriff zuweisen
    echo "<h3>Deine Suchergebnisse für: $suchbegriff</h3>"?>



<table class="table table-borderless">

    <tbody>

<?php


include_once("userdata.php");

try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE username LIKE '%$suchbegriff%'";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        echo "<tr><td scope='row'> <a href='profil.php?userid=$zeile->userid'><img class= 'img-circle' src=" . profilePicture($zeile->userid) . " height= '100px'/></a>&emsp;<a href='profil.php?userid=$zeile->userid'>$zeile->username</a></td>";
        echo "</tr>";

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
