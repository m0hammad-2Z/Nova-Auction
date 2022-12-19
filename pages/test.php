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

    async function x(){
        var x = await fetch("test2.php",{
            method:"post",
            body: JSON.stringify({a:"ACap" , 1:55})
        });
        var res = await x.json();
        console.log(res);
    }


    x();
    

 </script>
