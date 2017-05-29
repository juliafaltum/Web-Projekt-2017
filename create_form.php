<?php
/**
 * Created by PhpStorm.
 * User: Julia
 * Date: 08.05.2017
 * Time: 13:10
 */
include_once("session_check.php");

?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<body>
<h1>Neuer Tweet</h1>
<form action="create_do.php" method="post" enctype="multipart/form-data">
    Text des Tweets: <br>
    <input type="text" name="contentTXT" size="80" maxlength="500" /> <br><br>
    Tweet Bild: <input type="file" name="fileToUpload" id="fileToUpload">
    Tweet Quelle: <input type="text" name="contentSource" /><br>

    <input type="submit" value="Tweeten" />
</form>
</body>
</html>