<?php include_once ("header.php");
include_once("session_check.php");?>

    <!DOCTYPE html>
    <html>

    <body>

    <form action="profilbild_upload_do.php" method="post" enctype="multipart/form-data">
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
 * Date: 27.06.2017
 * Time: 19:02
 */