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
    
    <form method="post" enctype="multipart/form-data">
        <label for="file" >image<input name="img" type="file"></label>
        <button type="submit" name="but">send</button>
    </form>
    
</body>
</html>


<script>
    const arr = fetch("getComments.php?item_id=4")
        .then((response) => response.json())
        .then((user) => {
        return user;
    });

    console.log(arr);
 </script>
