<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 08.05.2017
 * Time: 13:07
 */

session_start();
$_SESSION = array(); // Session Array leeren

if (ini_get("session.use_cookies")) { // siehe PHP Manual http://php.net/manual/de/function.session-destroy.php
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
}


session_destroy();
header('Location: index.php');
?>