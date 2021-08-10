<?php 
    include("check.php");   
?>


    <?php 

    if ($loginst == 1){ ?>
        <div id="nav">
            USER
        </div>

    <?php } else { ?>
        <div id="nav">
            ADMIN/LOGGED OUT 
        </div> 
    <?php } ?>