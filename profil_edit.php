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

        echo "<form action='profil_edit_do.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='userid' value='$zeile->userid' />";
        echo "Name: <input type='text' name='fullname' size='30' value='$zeile->fullname' /><br>";
        echo "E-Mail: <input type='text' name='email' size='30' value='$zeile->email' /><br>";
        echo "Bild auswählen:<input type='file' name='fileToUpload' id='fileToUpload'>";
        echo "<input type='submit' value='Abbrechen' />";
        echo "<input type='submit' value='Profil bearbeiten' />";
        echo "</form>";

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
