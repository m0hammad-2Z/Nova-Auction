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
    <link rel='stylesheet' href='/Nova-Auction/css/styles.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .fa-gears{
    font-size: 15em;
    color: gray;
    }
    .main{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    }
    h3{
        margin-top : -0.2em;
        margin-bottom : 0.0em;
        font-size: 6em;
        color:gray;
    }
    p{
        margin:-0.8em;
        font-weight:500;
    }
</style>
</head>
<body>
    <?php printNav(); ?>
    <div class="main">
            <i class='fa fa-gears'></i>
            <h3>404</h3>
            <h2>Page not found</h2>
            <p>The page you are looknig for does not exist!</p>
            
    </div>

    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By <a href='/Nova-Auction/pages/about.php'>Humble Ghost Team</a></p>
    </footer>
</body>
</html>