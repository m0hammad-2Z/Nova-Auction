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
    <?php 
        if(isset($_POST['but'])){
            print_r( $_FILES['img']);


        $filename = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];   
        $folder = "../user_images/" . $filename;
        move_uploaded_file($tempname, $folder);
        }
    ?>
</body>
</html>


<script type="text/javascript">

 </script>
