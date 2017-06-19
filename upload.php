<?php include_once ("header.php");?>

<!DOCTYPE html>
<html>

<body>

<form action="Upload_do.php" method="post" enctype="multipart/form-data">
    Bild auswählen:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Bild hochladen" name="submit">

</form>
</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: molin
 * Date: 15.05.2017
 * Time: 13:03
 */