<?php include_once ("res.php");?>

<h1>Neues Passwort anfordern</h1>
<p>Hier können Sie ein neues Passwort anfordern. Geben Sie zur Bestätigung Ihre E-Mail Adresse an.</p>

<form action="reset_password_do.php" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">E-Mail:</span>
        <input type="text" class="form-control" name="E-Mail"  aria-describedby="basic-addon1">
    </div>
    <br>
    <input class='btn btn-success' type="submit" value="Neues Passwort anfordern" />

</form>