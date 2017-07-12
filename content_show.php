<?php include_once ("header.php");?>
<?php include_once("session_check.php");?>
<?php include_once("functions.php");

$hideAnzeigen = 1;

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>


<body>

<?php



try {// Anzeigen von einzelnem Tweet
include_once("userdata.php");

$contentID = (int)$_GET["contentID"];
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE contentID=$contentID"; //Join, damit man den username auslesen kann
$query = $db->prepare($sql);
$query->execute();
?>

<div class='col-md-6 center-element'>

    <?php
    while ($zeile = $query->fetchObject()) {

        showContentSpecific($contentID);

    }

    $db = null;
}

    catch (PDOException $e) {
        echo "Error!: Bitten wenden Sie sich an den Administrator...";
        die();
    }

?>



<br>
    <a class="btn btn-primary" href="index.php"><i class="fa fa-chevron-left" aria-hidden="true"></i> Zurück</a>

</div>

</body>
