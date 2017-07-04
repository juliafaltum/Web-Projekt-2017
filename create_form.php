<?php include_once("session_check.php"); ?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<h1>Neue Welle</h1>
<form action="create_do.php" method="post" enctype="multipart/form-data">
    Text der Welle: <br>
    <input type="text" name="contentTXT" size="80" maxlength="500" /> <br><br>
    Welle Bild: <input type="file" name="fileToUpload" id="fileToUpload">
    Welle Quelle: <input type="text" name="contentSource" /><br>

    <input type="submit" value="absenden" />
</form>
</body>
</html>