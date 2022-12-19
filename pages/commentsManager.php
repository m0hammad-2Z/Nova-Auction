<?php
// init PHP
require_once "../lib.php"; 

if(isset($_GET["choose"])){
    if($_GET["choose"]==1){
        if(!empty($comments = Database("select * from comment where item_id = {$_GET["item_id"]} order by date_of_comment asc",1))){
            
            for($i = 0 ;$i<count($comments);++$i){
                if($comments[$i]["user_id"] == Database("select user_id from items where id = {$_GET["item_id"]}",1)[0][0]){
                    $commentsArray[] = array($comments[$i]["comment"] , $comments[$i]["date_of_comment"],1);
                }
                else{
                    $commentsArray[] = array($comments[$i]["comment"] , $comments[$i]["date_of_comment"],0);
                }
            }
        }else{
            $commentsArray[0][0]="empty";
        }

    echo json_encode($commentsArray);
    }
    elseif(checkUserId()){
        if($_GET["user_comment"] == ""){
            return;
        }
        Database("INSERT INTO comment VALUES (default,'{$_GET["user_comment"]}',{$_SESSION["user_id"]},{$_GET["item_id"]},(select sysdate()))",0);
                   
    
    }
}
?>