<?php include_once("session_check.php");
include_once ("userdata.php");


$user = $_GET['user'];
$follower = $_GET['follower'];
$contentID = $_GET['contentID'];

if (($user != $follower) && (!empty($user))) {       // überprüfen ob man selbst Autor des Tweets ist & eingeloggt ist, wenn ja ab zur else unten

global $dsn, $dbuser, $dbpass;
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist WHERE user = :user AND follower = :follower";
$query = $db->prepare($sql);
$query->bindParam(':user', $user);
$query->bindParam(':follower', $follower);
$query->execute();

while ($zeile = $query->fetchObject()) {
$folgt = 1;

}

if ($folgt == 1) {
echo "<div id='unfollowbutton$contentID'><a href='#'><img height='50px' src='img/unfollow_Button.png'></a></div>";
    ?>

<script type="text/javascript">
    $('#unfollowbutton<?php echo $contentID;?>').click(function (e) {
                e.preventDefault();
                $('#unfollowbutton<?php echo $contentID;?>').load("unfollow_do.php?entfolgeuser=<?php echo $follower;?>");
            });
    </script>

    <?php

} else {

    echo "<div id='followbutton$contentID'><a href='#'><img height='50px' src='img/follow_Button.png'></a></div>";
    ?>

    <script type="text/javascript">
            $('#followbutton<?php echo $contentID;?>').click(function (e) {
                e.preventDefault();
                $('#followbutton<?php echo $contentID;?>').load("follower_do.php?user=<?php echo $follower;?>");
            });
    </script>

    <?php


}

}
else {
// Es wird kein Follow Knopf angezeigt
}
