<?php include_once ("header.php");?>

<?php // Nutzer wird erstellt mit vorhandenen Daten aus Formular, Fehlermeldung bei fehlenden Angaben
include_once("userdata.php");



$username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
$fullname = htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8");
$email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");

$NOHASHpassword = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
$password = password_hash($NOHASHpassword, PASSWORD_DEFAULT);

    $Kontrollepassword = $_POST["password"];
    $Kontrollepassword2 = $_POST["password2"];

if ($Kontrollepassword != $Kontrollepassword2) {
        echo "Die Passwörter stimmen nicht überein!";
        die();
        }



// Nur wenn Bild gesetzt ist, Wert in die DB schreiben!
if (file_exists($_FILES['fileToUpload']['tmp_name'])){

    include_once("Upload_do.php");
}
else {
    $uploadfile = 0;
}



if (!empty($username) && !empty($fullname) && !empty($email)) {

    try {
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "INSERT INTO user (username, fullname, email, password, usercreated, profilePicture ) VALUES(:username, :fullname, :email, :password, NOW(), :profilePicture)");
        $query->execute(array("username" => $username, "fullname" => $fullname, "email" => $email, "password" => $password, "profilePicture" => $uploadfile) );
        $db = null;
    } catch (PDOException $e) {
        echo "Error!: Bitten wenden Sie sich an den Administrator...";
        die();
    }
    header('Location: create_user_done.php');
}
else {
    echo "Error: Bitte alle Felder ausfüllen!<br/>";
}