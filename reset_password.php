<?php include_once ("header.php");?>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<h1>Neues Passwort anfordern</h1>
Hier können Sie ein neues Passwort anfordern.

<form action="reset_password_do.php" method="post" enctype="multipart/form-data">
    E-Mail: <input type="text" name="email" size="20" maxlength="500" /> <br><br>

    <input type="submit" value="Neues Passwort anfordern" />
</form>
</body>
</html>