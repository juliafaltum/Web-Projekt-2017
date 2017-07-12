<?php include_once("session_check.php");
include_once ("header.php");?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>

<body>
<div class='col-md-6 center-element'>
<?php

$contentID = (int)$_GET["contentID"];
echo "<h3>Willst du deinen Tweet wirklich löschen?</h3><br><br>";

echo "<div style='text-align: left'><a href='delete.php?contentID=$contentID' class='btn btn-danger'>Löschen</a>&emsp;<a href='content_show.php?contentID=$contentID' class='btn btn-primary' type='submit'>Abbrechen</a></div>";
?>

</body>
</html>
