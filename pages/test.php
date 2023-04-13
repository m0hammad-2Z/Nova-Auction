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
    <?php
$json =  file_get_contents("php://input"); // json string
echo $json;

    if(isset($_POST["hi"])){
        print_r($_POST);
    }
    
    ?>
    <input type="file" name="f" id="f" onchange="test()" multiple>
    <form action="" method="post">
        <input type="hidden" name="img" id="photoss">
        <button type="submit" name="hi">submit</button>
    </form>

</body>
</html>


<script>
let photos = Array();
function test(){
    photos = [...document.getElementById("f").files];
    console.log(photos);
    photos.splice(1,1);
    console.log(photos);
    fetch('test.php', {method: "POST",headers: {'Content-Type': 'multipart/form-data'}, body: photos});
}


</script>
