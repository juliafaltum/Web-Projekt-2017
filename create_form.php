<?php include_once("session_check.php"); ?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<h1>Neue Welle</h1>

<form action="create_do.php" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="input3">Text der Welle:</label>
    <textarea id="input3" class="form-control" name="contentTXT" size="80" maxlength="500" rows="3" aria-describedby="basic-addon1"></textarea>
</div>
    <br>
    <label for="wellebild">Bild:</label>
    <input id="wellebild" type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <label for="wellequelle">Quelle:</label><br>
    <input style="width: 400px" id="wellequelle" type="text" name="contentSource" /><br><br>

    <input type="submit" value="absenden" />
</form>
</body>
</html>