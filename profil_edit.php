<?php include_once ("header.php");?>
<?php
include_once("session_check.php");

?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<body>

<?php
try {
    include_once("userdata.php");
    $userid = $_SESSION["userid"];
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE userid = $userid";
    $query = $db->prepare($sql);
    $query->bindParam('userid', $userid);
    $query->execute();
    if (($zeile = $query->fetchObject()) && ($_SESSION['userid']==$zeile->userid)) { // Abgleichen der UserID mit der Session --> Kann nur von jeweiliger Person verändert werden

        echo "<div class='col-md-3 left-element'></div>";
        echo "<div class='col-md-6 center-element'>";
        echo "<form action='profil_edit_do.php' method='post'>";
        echo "<input type='hidden' name='userid' value='$zeile->userid' />";
        echo "<h2>Bearbeite dein Profil:</h2>";
        echo "<div class='input-group''>";
            echo "<span class='input-group-addon' id='basic-addon1'>Name:</span><input type='text' class='form-control' name='fullname' value='$zeile->fullname' aria-describedby='basic-addon1'>";
        echo "</div><br>";
        echo "<div class='input-group''>";
            echo "<span class='input-group-addon' id='basic-addon1'>E-Mail:</span><input type='text' class='form-control' name='email' value='$zeile->email' aria-describedby='basic-addon1''>";
        echo "</div><br>";
       // echo "<div class='input-group'>";
       //         echo "<span class='input-group-addon'>Profilbild:</span><input type='file' class='form-control' placeholder='Profilbild hochladen' name='fileToUpload' id='fileToUpload' aria-describedby='basic-addon1''>";
       // echo "</div>";
       // echo "<br>";
        echo "<div style=\"text-align: right\"><a href='profil.php?userid=$zeile->userid' class='btn btn-danger' type='submit'>Abbrechen</a>&emsp;<input class='btn btn-primary' type='submit' value='Profil bearbeiten'></div>";
        echo "</form>";
        echo "</form>";
        echo "</div>";
        echo "<div class='col-md-3 right-element'></div>";

    } else {
        echo "Datensatz nicht gefunden oder das ist nicht dein Profil!";
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

?>


</body>
</html>
