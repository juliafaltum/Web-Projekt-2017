<?php include_once ("header.php");?>
<?php
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="col-md-3 left-element"></div>
<div class="col-md-6 center-element">
    <h1>Nutzer erfolgreich erstellt!</h1>
<h2>Bitte melde dich an</h2>
    <br>
<form action="login_do.php" method="post">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Benutzername:</span><input name="username" type="text" class="form-control" placeholder="Benutzername" aria-describedby="basic-addon1">
    </div>
    <br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Passwort:</span><input name="password" type="password" class="form-control" placeholder="Passwort" aria-describedby="basic-addon1">
    </div>
    <br><input class=" btn-lg btn-block btn-primary" type="submit" value="Anmelden" />

</form>
<br><a href="reset_password.php">Passwort vergessen?</a>
</div>
<div class="col-md-3 right-element"></div>
</body>
</html>

