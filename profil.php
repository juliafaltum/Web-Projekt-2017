<?php
include_once("session_check.php");
?>

    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
    </head>

<body>

<?php

$geholteuserID = $_GET['userid'];

include_once("userdata.php");
include_once("functions.php");

showProfile ($geholteuserID);

    ?>
    <br>



    </body>
    </html>
