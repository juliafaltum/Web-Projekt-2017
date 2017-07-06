<?php
include_once('header.php');

?>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img src="img/Logo_navbar.png" alt="ola" >
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="hoechstewellen.php">Höchste Wellen<span class="sr-only">(current)</span></a></li>
            </ul>
            <form method= "post" action="suche_do.php" class="navbar-form navbar-left hidden-sm-down">
                <div class="form-group">
                    <input style="width: 300px"name="suchbegriff" type="text" class="form-control" placeholder="Benutzer suchen">
                </div>
                <button type="submit" class="btn btn-default">Suchen</button>
            </form>
<?php

if(!isset($_SESSION['userid'])) {
    ?>
    <form method="post" action="login_do.php" class="navbar-form navbar-right">
        <div class="input-group">
         <input style="width: 150px" type="text" name = username class="form-control" placeholder="Benutzername" aria-describedby="basic-addon1">
         <input style="width: 150px" type="password" name = password class="form-control" placeholder="Passwort" aria-describedby="basic-addon1">
      </div>
         <button type="submit" class="btn btn-default">Anmelden</button>
    </form>


<?php       }
    if(isset($_SESSION['userid'])) {
?>
            <div class="navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown navbar-right">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> Profil<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $userid = $_SESSION['userid'];
                            echo "<li><a href=\"profil.php?userid=$userid\">Profil anzeigen</a></li>";
                            echo "<li><a href=\"profil_edit.php\">Profil bearbeiten</a></li>";
                            echo "<li role=\"separator\" class=\"divider\"></li>";
                            echo "<li><a href=\"logout.php\">Abmelden</a></li>";
                            ?>
                    </ul>
                </li>
                    </ul>
            </div>
<?php                             }
?>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>