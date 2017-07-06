<?php include_once ("header.php");?>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="col-md-3 left-element"></div>
<div class="col-md-6 center-element">
<h1>Neues Passwort anfordern</h1>
Hier können Sie ein neues Passwort anfordern.
    <br>
    <br>

<form action="reset_password_do.php" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">E-Mail:</span>
        <input type="text" class="form-control" name="E-Mail"  aria-describedby="basic-addon1">
    </div>
    <br>
    <input type="submit" value="Neues Passwort anfordern" />
</div>
<div class="col-md-3 right-element"></div>
</form>
</body>
</html>