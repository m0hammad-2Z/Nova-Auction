<?php
// init PHP
require_once "../lib.php"; 
set_time_limit(10);
ignore_user_abort(false);

    $reqPOST = json_decode(file_get_contents("php://input"), true);
    
    if(!empty($reqPOST) && checkUserId() && $reqPOST['user_id'] != $_SESSION["user_id"]){
        Database("INSERT INTO notifications VALUES (default, {$reqPOST['user_id']}, {$reqPOST['item_id']}, 'call', default)", 0);
        echo json_encode("Done");
        die();
    }
    

?>