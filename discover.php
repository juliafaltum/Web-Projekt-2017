<?php include_once ("header.php");
include_once("session_check.php"); ?>




<div class="container">

    <div class="row">
        <div class="col-md-5 center-element text-center">
        <h1>Alle Wellen der Community!</h1><br>
    </div>





        <div class="col-md-8 center-element">
            <div class="well-own" id="tweetformular" style="display: none;"><?php include_once ('create_form.php');?></div>

            <?=showContentAll();?>



        </div>




</div>
</div>
</div>