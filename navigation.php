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
                <img data-toggle="tooltip" title="Persönliche Startseite" data-placement="bottom" src="img/Logo_navbar.png" alt="ola" >
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php" data-toggle="tooltip" title="Alle Wellen ansehen" data-placement="bottom" >Entdecken</a></li>
                <li><a data-toggle="tooltip" title="Besten Wellen ansehen" data-placement="bottom" href="hoechstewellen.php">Höchste Wellen</a></li>
            </ul>
            <form method= "post" action="suche_do.php" class="navbar-form navbar-left hidden-sm-down">
                <div class="form-group">
                    <input name="suchbegriff" type="text" class="form-control" placeholder="Benutzer suchen">
                </div>
                <button type="submit" class="btn btn-default">Suchen</button>
            </form>
<?php

if(!isset($_SESSION['userid'])) {
    ?>
    <form method="post" action="login_do.php" class="navbar-form navbar-right" role="search">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Benutzername">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Passwort">
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
                           aria-expanded="false">Profil <i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $userid = $_SESSION['userid'];
                            echo "<li><a href=\"profil.php?userid=$userid\">Profil anzeigen <i class=\"fa fa-user\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"photoGallery.php\">Privates Fotoalbum <i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"profil_edit.php\">Profil bearbeiten <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li role=\"separator\" class=\"divider\"></li>";
                            echo "<li><a href=\"logout.php\">Abmelden <i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i></a></li>";
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