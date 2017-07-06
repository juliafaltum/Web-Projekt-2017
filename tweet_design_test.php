<?php
include_once ('header.php');
include_once ('functions.php');
include_once ('userdata.php');





?>


<br><br>

<body>

<div class="container">

    <div class="row spacer">

        <div class="well-own col-md-4">

            Hallo Spalte 1
            <div class="row">

                <div class="col-md-5">

                    asdhadhjsdjh
                </div>

            </div>


            </div>


        <div class="col-md-4">

        </div>

        <div class="col-md-4">

            Hallo Spalte 2

        </div>




    </div>



    <div class="row">


        <div class="well-own col-md-8 center-element">

            <a href="#" data-toggle="tooltip" title="Hooray!">Hover over me</a>



        </div>


    </div>


</div>


<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
