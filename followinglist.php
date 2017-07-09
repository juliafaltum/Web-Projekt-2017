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

echo "<div class='col-md-3 left-element'></div>";
echo "<div class='col-md-6 center-element'>";
while ($zeile = $query->fetchObject()) {
    echo "<h2>$zeile->username abonniert diese Nutzer:<br></h2>";
}

echo "<br>";

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.follower=user.userid WHERE followerlist.user = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

$profilePictureURL = profilePicture($festgelegteUserID);

?>
<link rel="stylesheet"  href="css/custom_css.css">
 <table class="table table-borderless">

    <tbody>

<?php
while ($zeile = $query->fetchObject()) {
    echo "<tr><td scope='row'> <a href='profil.php?userid=$zeile->userid'><img class= 'img-circle' src=" . profilePicture($zeile->userid) . " height= '100px' width= '100px'/></a>&emsp;<a href='profil.php?userid=$zeile->userid'>$zeile->username</a></td>";
    echo "</tr>";
}
?>

</tbody>
</table>

<div style='text-align: right'>
    <?php
    echo "<a href='profil.php?userid=$festgelegteUserID' class='btn btn-primary'>Zurück zum Profil</a><br><br>"
?>
</div>
<div class='col-md-3 right-element'></div>