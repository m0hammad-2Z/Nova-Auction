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
                    <button class='button'>Call Now</button>
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
            <div class='item-comments'></div>
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

<?php
                if(isset($_POST["button"])){
                    if(checkUserId()){
                        Database("INSERT INTO comment VALUES (default,'{$_POST["user_comment"]}',{$_SESSION["user_id"]},{$_GET["item_id"]},(select sysdate()))",0);
                    }
                }
                ?>
<script defer>
    var item_id = <?php echo $_GET["item_id"]; ?>;
    var comment = document.getElementsByName("user_comment")[0];
    var last_fetch_comments=0;
    var container = document.getElementsByClassName('item-comments')[0];
    
    async function insert_comment(){
       
        
        var insertComment = await fetch("commentsManager.php",{
            method:"post",
            body: JSON.stringify({choose:0 , user_comment:comment.value,item_id:item_id})
        });
        var res = await insertComment.json();
    
        comment.value= "";
        comment.disabled = true;
    }
    

      async function get_comment(){
        var getComments = await fetch("commentsManager.php",{
            method:"post",
            body: JSON.stringify({choose:1 ,item_id:item_id ,last_count:last_fetch_comments})
        })
        .then((reqres) => reqres.json())
        .then((res)=>{

            if(res != 'noNew'){
            last_fetch_comments += res.length;
            for(var i = res.length -1;i>=0;--i){
                var node = document.createElement("div");
                node.className = 'item-comment';
                if(res[i][5] == 0){
                    node.style = 'text-align: left; justify-self:flex-start; background-color:var(--color-hover)';
                }
                else {
                    node.style = 'text-align: right; justify-self:flex-end; background-color:greenyellow';
                }
                var user_brief = document.createElement("div");
                user_brief.className = "user-brief";
                var link_to_user_account = document.createElement("a");
                link_to_user_account.href = "user.php?user_id="+res[i][2];
                link_to_user_account.innerHTML = res[i][6];
                user_brief.appendChild(link_to_user_account);
                var comment_text = document.createElement("p");
                comment_text.innerHTML = res[i][1];
                var date_div = document.createElement("div");
                var date_text =document.createElement("p");
                date_text.innerHTML=  res[i][4];
                date_div.appendChild(date_text);
                node.appendChild(user_brief);
                node.appendChild(comment_text);
                node.appendChild(date_div);
                container.appendChild(node);
            }
            container.scrollTop = container.scrollHeight;
            comment.disabled = false;
        }
            
        })
        .catch(error => {
            
        });
        
        // get_comment();
        
    }
    // get_comment();
    setInterval(x,5000);
</script>
</html>