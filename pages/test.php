<?php
// init PHP
require "../lib.php"; 
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
    <form method="post" enctype="multipart/form-data">
        <label for="file" >image<input name="img" type="file"></label>
        <button type="submit" name="but">send</button>
    </form>
    
</body>
</html>


<script>
    var x;
    async function s(){
    let obj;
    const arr = await fetch("getComments.php?item_id=4");
        obj = await arr.json();
        console.log(obj)
        for(var i = 0;i<obj.length;++i){
            var node = document.createElement("div");
            node.className = 'item-comment';
            if(obj[i][2] == 0){
                node.style = 'justify-self:start; background-color:var(--color-hover)';
            }
            else {
                node.style = 'justify-self:end; background-color:greenyellow';
            }
            node.innerHTML = obj[i][0];
            document.getElementById('i').appendChild(node);
        }
    }
        s();
 </script>
