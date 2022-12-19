<?php
// init PHP
require_once "../lib.php"; 
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

<body>
    <?php printNav(); ?>
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
                <?php
                if(isset($_POST["button"])){
                    if(checkUserId()){
                        Database("INSERT INTO comment VALUES (default,'{$_POST["user_comment"]}',{$_SESSION["user_id"]},{$_GET["item_id"]},(select sysdate()))",0);
                    }
                }
                   
                ?>
            </div>
            <div class='comment-form'>
                <input type="text" name="user_comment" placeholder="Your comment...">
                <button class='button' onclick="insert_comment()" name='button'>comment</button>
            </div>
        </div>
    </div>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
<script>
    
    async function insert_comment(){
        var item_id = <?php echo $_GET["item_id"]; ?>;
        var comment = document.getElementsByName("user_comment")[0].value;
        await fetch("commentsManager.php?choose=0&item_id="+item_id+"&user_comment="+comment);
        document.getElementsByName("user_comment")[0].value= "";
        
    }
    var length = 0;
    async function s(){
        var container = document.getElementsByClassName('item-comments')[0];
        let obj;
        const arr = await fetch("commentsManager.php?choose=1&item_id=<?php echo $_GET["item_id"]; ?>");
            obj = await arr.json();
            console.log(obj)
            while (container.lastChild) {
                container.removeChild(container.lastChild);
                }
            for(var i = 0;i<obj.length;++i){
                var node = document.createElement("div");
                node.className = 'item-comment';
                if(obj[i][2] == 0){
                    node.style = 'justify-self:flex-start; background-color:var(--color-hover)';
                }
                else {
                    node.style = 'justify-self:flex-end; background-color:greenyellow';
                }
                node.innerHTML = obj[i][0];
                container.appendChild(node);
            }
            if(obj.length != length){
                container.scrollTop = container.scrollHeight;
            }
            length = obj.length;
        }
    s();
    setInterval(s,1000);

</script>
</html>