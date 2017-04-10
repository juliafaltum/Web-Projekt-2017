<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<h1>Nutzerliste</h1>
<body>
<table>
    <thead>
    <th>UserID</th>
    <th>Username</th>
    <th>Fullname</th>
    <th>Email</th>
    <th>Passwort MD5 Hash</th>
    </thead>
    <tbody>

    <?php

    include_once("userdata.php");

    try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        echo "<tr>";
        echo "<td>$zeile->userid</td>";
        echo "<td>$zeile->username</td>";
        echo "<td>$zeile->fullname</td>";
        echo "<td>$zeile->email</td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>


</body>
</html>

<?php
$db = null;
} catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!?...".$e;
    die();
}
?>