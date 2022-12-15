<?php
// init PHP
require "../lib.php"; ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Item name</title>
    <link rel='stylesheet' href='/Nova-Auction/css/styles.css'>
    <link rel='stylesheet' href='/Nova-Auction/css/item.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
</head>

<body>
    <?php printNav(); ?>

    <?php 
     $item = Database("select * from items,cars,user_info where items.id = {$_GET["item_id"]} and user_info.id = (select user_id from items where items.id = {$_GET["item_id"]}) and cars.id = (select car_id from items where items.id = {$_GET["item_id"]})",1,MYSQLI_NUM);
     print("
        <div class='main'>
            <div class='left'>
                <img src='../{$item[0][3]}' alt=''>
            </div>
    
        <div class='right'>
            <div>
                <h1>{$item[0][1]}</h1>
                <p>{$item[0][9]} {$item[0][10]} {$item[0][11]}</p>
            </div>

            <p>Seller Name: {$item[0][13]} {$item[0][14]}</p>
            <p>Location: {$item[0][7]}</p>

            <p>Current price: {$item[0][4]}$</p>
            <button class='button'>Buy Now</button>
        </div>
    </div>

    <div class='item-desc'>
        <h1>Description</h1>
        <h2>More Info About This Item</h2>
        <p>
        {$item[0][2]}
        </p>
    </div>
    ");
    ?>

    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>

</html>