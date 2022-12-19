<?php
// init PHP
require "../lib.php"; 
?>
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

<body><?php printNav(); ?>
<div class='main'>
    

    <?php 
    if(!isset($_GET["item_id"])){
        header("Location: /Nova-Auction/pages/products.php");
        
    }
     $item = Database("select * from items,cars,user_info where items.id = {$_GET["item_id"]} and user_info.id = (select user_id from items where items.id = {$_GET["item_id"]}) and cars.id = (select car_id from items where items.id = {$_GET["item_id"]})",1,MYSQLI_NUM);
     
     print("
       
            <div class='item-details'>
                <img src='../{$item[0][3]}' alt=''>
                <div>
                    <h1>{$item[0][1]}</h1>
                    <p>Car Model: {$item[0][9]} {$item[0][10]} {$item[0][11]}</p>
                </div>

                <p>Seller Name: {$item[0][13]} {$item[0][14]}</p>
                <p>Location: {$item[0][7]}</p>

                <p>Current price: {$item[0][4]}$</p>
                <button class='button'>Buy Now</button>
            </div>      
        

            <div class='item-desc'>
                <h1>Description</h1>
                <p>
                {$item[0][2]}
                </p>
            </div>
        
    ");
    ?>
    <div class='item-comment-container'>
        <h1>Comment</h1>
        <div class='item-comments'>
            <div class='item-comment' style='justify-self:end; background-color:greenyellow'>how much is this item?</div>
            <div class='item-comment' style='justify-self:start; background-color:var(--color-hover)'>as it is included in the post it is 15000 jod</div>
            <div class='item-comment' style='justify-self:start; background-color:var(--color-hover)'>if you are intrested you can call me at 0796412364</div>
            <div class='item-comment' style='justify-self:end; background-color:greenyellow'>ok wait for my call at 9pm</div>
            <div class='item-comment' style='justify-self:end; background-color:greenyellow'>ok wait for my call at 9pm</div>
            <div class='item-comment' style='justify-self:end; background-color:greenyellow'>ok wait for my call at 9pm</div>
            <div class='item-comment' style='justify-self:end; background-color:greenyellow'>أسمع برنلك اليوم المسا عالتسعة إن شاء الله</div>
        </div>
        <form method="POST" class='comment-form'>
            <input type="text" placeholder="Your comment...">
            <button class='button'>comment</button>
        </form>
    </div>
    <?php 
    
    ?>
    </div>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>

</html>