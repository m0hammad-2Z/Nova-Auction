<?php
// init PHP
require "../lib.php"; 
$res =Database("select makes_name , model_name from car_info_makes,car_info_model where makes = car_info_makes.id ",1);

?>



<script type="text/javascript">
    
    var jArray = <?php echo json_encode($res); ?>;
    console.log(jArray);
 

 </script>
