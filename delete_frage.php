<?php include_once ("header.php");?>
<?php include_once("session_check.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>

<body>
<?php


$contentID = (int)$_GET["contentID"];
echo "Willst du deinen Tweet mit der ID: $contentID wirklich löschen?<br>";
echo "<a href='delete.php?contentID=$contentID'>Ja</a><br>";
echo "<a href='index.php'>Nein</a>";
?>

</body>
</html>
