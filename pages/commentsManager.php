<?php
// init PHP
require_once "../lib.php"; 

set_time_limit(10);
ignore_user_abort(false);


    $Not_POST = json_decode(file_get_contents("php://input"),true);
    if(empty($Not_POST)){
        die() ;
    }
    if($Not_POST['choose']==0){
          if(checkUserId() && $Not_POST["user_comment"] != ""){
            Database("INSERT INTO comment VALUES (default,'{$Not_POST["user_comment"]}',{$_SESSION["user_id"]},{$Not_POST["item_id"]},(select sysdate()))",0);
            
                $res = Database("SELECT Distinct user_id from comment where item_id = {$Not_POST["item_id"]} and user_id <> {$Not_POST["user_id"]} and user_id <> {$_SESSION["user_id"]}", 1);  
                foreach($res as $r){
                    Database("INSERT INTO notifications VALUES (default, {$r['user_id']},'{$Not_POST["item_id"]}','commment',default)",0);
                }
                if($Not_POST["user_id"] != $_SESSION["user_id"]){
                    Database("INSERT INTO notifications VALUES (default, {$Not_POST["user_id"]},'{$Not_POST["item_id"]}','commment', default)",0);
                }
                
                // if(count(Database("select user_id from notifications where user_id = {$_SESSION["user_id"]}", 1)) == 0){
                //     Database("INSERT INTO notifications VALUES (default, {$_SESSION["user_id"]},'{$Not_POST["item_id"]}','commment', 1)",0);
                // }

            
            echo json_encode("inserted");
            die();
        }else{
            die() ;
        }
    }elseif($Not_POST['choose']==1){
        $comments = Database("select count(id) from comment where item_id = {$Not_POST["item_id"]}",1,MYSQLI_NUM);
        if($comments[0][0]-$Not_POST['last_count']!=0){
            if(checkUserId()){
                echo json_encode(Database("select *,if({$_SESSION["user_id"]} = user_id, 1,0),(select first_name from user_info where user_info.id = user_id) from comment where item_id = {$Not_POST["item_id"]} order by date_of_comment desc limit ".($comments[0][0]-$Not_POST['last_count']),1,MYSQLI_NUM));
            }else{
                echo json_encode(Database("select *,0,(select first_name from user_info where user_info.id = user_id) from comment where item_id = {$Not_POST["item_id"]} order by date_of_comment desc limit ".($comments[0][0]-$Not_POST['last_count']),1,MYSQLI_NUM));
            }
                die();
        }else
        {
            echo json_encode("noNew");
            die();
        }
    } 


?>