<?php
    $plate = 0;
    if(!isset($_GET['plate']))
        ;
    else
        $plate = $_GET['plate'];
        
    $plate = 0;
?>      
<img src="plates/plate-<?php echo $plate; ?>.jpg" class="img-rounded img-responsive"/>