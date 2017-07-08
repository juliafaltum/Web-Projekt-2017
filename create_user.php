<?php include_once ("header.php");?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="js/passwordcheck.js" data-no-instant></script> <!-- Passwort überprüfen mit Javascript, dazu braucht man das oben eingebundene JQuery-->
</head>
<body>
<div class="col-md-3 left-element"></div>
<div class="col-md-6 center-element">
    <h1>Neuer Benutzer</h1>
    <br>
    <form action="create_user_do.php" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Benutzername:*</span><input type="text" class="form-control" placeholder="Benutzername" name="username" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Voller Name:*</span><input type="text" class="form-control" placeholder="Voller Name" name="fullname" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">E-Mail:*</span><input type="text" class="form-control" placeholder="E-Mail" name="email" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon">Passwort:*</span><input id="txtNewPassword" type="password" class="form-control" placeholder="Passwort" name="password" onChange="checkPasswordMatch();" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" >Passwort wiederholen:*</span><input id="txtConfirmPassword" type="password" class="form-control" placeholder="Passwort" onChange="checkPasswordMatch();" name="password2" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group">
                <span class="input-group-addon" >Profilbild hochladen:</span><input type="file" class="form-control" placeholder="Profilbild hochladen" name="fileToUpload" id="fileToUpload" aria-describedby="basic-addon1">
        </div>
        <br>

    <div class="registrationFormAlert" id="divCheckPasswordMatch">        </div>
    <div style="text-align: right"><input id="absenden" class="btn btn-primary"disabled type="submit" value="Benutzer erstellen" />  <!-- Disabled macht den Button nicht klickbar, wird später per JS aktiviert -->
    </div>
    </form>
</div>
<div class="col-md-3 right-element"></div>
</body>
</html>
