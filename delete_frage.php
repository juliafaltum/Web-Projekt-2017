<?php include_once ("header.php");?>
<!DOCTYPE html> <!-- das ist HTML 5 -->
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>

<body>
<?php
$contentID = (int)$_GET["contentID"];
echo "Soll der Datensatz Nr.$contentID gelöscht werden?<br>";
echo "<a href='delete.php?contentID=$contentID'>JA</a>;";
echo "<a href='index.php'>NEIN</a>";
?>

</body>
</html>




/**
 * Created by PhpStorm.
 * User: molin
 * Date: 15.05.2017
 * Time: 12:16
 */