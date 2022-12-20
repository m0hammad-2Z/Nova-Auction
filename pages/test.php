<?php
// init PHP
require_once "../lib.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="i">

    </div>
</body>
</html>


<script>
var last_fetch_comments=0;
    async function x(){
        
        var getComments = await fetch("commentsManager.php",{
            method:"post",
            body: JSON.stringify({choose:1 , user_comment:"welcomesir",item_id:2 ,last_count:last_fetch_comments})
        });
        var res = await getComments.json();
        console.log(res);
        if(res != 'noNew'){
            last_fetch_comments += res.length;
        }
        
    }
    setInterval(x,5000);
    

 </script>
