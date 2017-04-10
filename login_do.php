<?php

$username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");


$eingabePassword = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
$eingabepasswordhashed = hash_hmac('sha256', '$eingabePassword', '$saltPasssword');

$passwordausDB = "Muss noch gemacht werden!"; // Todo




// if a value is given
if (isset($_POST['username']));
{

    // connectivity to MySQL server
    include_once("userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);

    // after pressing login, checking if the variables exist in the database
    $query = $db->prepare("SELECT password FROM user WHERE username=?");
    $query->execute(array($_POST['username']));
    if ($query->fetchColumn() === $_POST['eingabepasswordhashed']) //better to hash it
    {
        // starts the session created if login info is correct
        session_start();
        $_SESSION['username'] = $_POST['username'];

        header("Location: members.php");
        exit;
    }

    else {}
}


