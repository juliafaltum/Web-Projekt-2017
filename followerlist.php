<?php
include_once ("header.php");
include_once ("userdata.php");
include_once ("session_check.php");





$festgelegteUserID = $_GET["userid"];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM user WHERE userid = :festgelegteUserID";
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    ?>

    <div class="panel panel-default">
        <!-- Default panel contents -->
    <?php
    echo "<div class=\"panel-heading\">$zeile->username wird von diesen Nutzern abonniert:</div>";
    ?>
    <div class="panel-body">
    <?php
    echo "<p><a href='profil.php?userid=$zeile->userid'>Zurück zum Profil</a></p>";
    ?>
  </div>


<?php
}
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.user=user.userid WHERE followerlist.follower = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();
?>

        <link rel="stylesheet"  href="css/custom_css.css">
        <table class="table table-borderless>

    <tbody>

<?php

        while ($zeile = $query->fetchObject()) {
    echo '<tr><td scope="row"> <img class= "img-circle" src= ' . profilePicture($zeile->userid) . ' height= "100px" width= "100px"  />' . $zeile->username . '</td>;
   
    </tr>';

    //echo "<a href='profil.php?userid=$zeile->userid'>$zeile->username</a><br>";
}
?>

    </tbody>
</table>
</div>

