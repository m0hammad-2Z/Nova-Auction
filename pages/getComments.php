<?php 
require "../lib.php"; 
$commentsArray;
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
?>