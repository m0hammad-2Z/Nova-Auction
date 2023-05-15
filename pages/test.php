<?php
// init PHP
require_once "../lib.php"; 

$users = Database('Select first_name, id from user_info', 1);

foreach($users as $i){
    $res = 'https://api.dicebear.com/6.x/initials/png?seed=' . $i[0] . rand(1, 5000);
    echo $res;
Database("UPDATE user_info SET img_path = '$res' where id = $i[1]", 0);

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body></body>
</html>


<script>
</script>
