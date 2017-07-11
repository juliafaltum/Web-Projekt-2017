<?php include_once ("header.php");

$festgelegteUserID = $_SESSION['userid'];

?>


<div class="container">

    <div class="row">
        <div class="col-md-5 center-element">
        <h1>Alle Wellen der Community!</h1><br>
    </div>


    </div>

    <div class="col-md-12">


        <div class="col-md-8 center-element">
            <div class="well-own" id="tweetformular" style="display: none;"><?php include_once ('create_form.php');?></div>

            <?=showContentAll();?>



        </div>

    </div>
    <div class="col-md-3 right-element"></div>

</div>
</div>
</div>