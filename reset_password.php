<?php include_once ("res.php");

if (isset($_GET['vonStartseite'])) {

    include_once ("header.php");
    echo "<div class='col-md-6 center-element'>";
}

?>



<h1>Neues Passwort anfordern</h1>
<p>Hier können Sie ein neues Passwort anfordern. Geben Sie zur Bestätigung Ihre E-Mail Adresse an.</p>

<form action="reset_password_do.php" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">E-Mail:</span>
        <input type="text" class="form-control" name="email"  aria-describedby="basic-addon1">
    </div>
    <br>
    <input class='btn btn-success' type="submit" value="Neues Passwort anfordern" />

</form>