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
    <link rel='stylesheet' href='/Nova-Auction/css/item(previously).css'>
    <link rel="icon" type="image/png" href="/Nova-Auction/img/fav.png">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
</head>

<body>
    <?php printNav(); ?>
    <div class='main'>
        

        <?php 
        if(!isset($_GET["item_id"]) ||  count(Database("select id from items where id = {$_GET['item_id']}", 1)) <= 0){
            header("Location: /Nova-Auction/pages/products.php"); 
        }
        $item = Database("select * from items,cars,user_info where items.id = {$_GET["item_id"]} and user_info.id = (select user_id from items where items.id = {$_GET["item_id"]}) and cars.id = (select car_id from items where items.id = {$_GET["item_id"]})",1);
        
        $interorsArray = '';

        foreach(unserialize($item[0]['interiors']) as $int){
            $interorsArray .= ucfirst($int) . ", ";
        }
        $interorsArray = substr_replace($interorsArray, "", -2);

        print("
        
                <div class='item-details'>
                    <img src='../{$item[0][3]}' alt=''>
                    
                    <h1>{$item[0][1]}</h1>
                    
                    <p class='item-elements'><b>Car Model:</b>         {$item[0][9]} {$item[0][10]} {$item[0][11]}</p>
                    <p class='item-elements'><b>Seller Name:</b>       {$item[0]['first_name']} {$item[0]['last_name']}</p>
                    <p class='item-elements'><b>Location:</b>          {$item[0][7]}</p>
                    <p class='item-elements'><b>Car Color:</b>         {$item[0]['color']}</p>
                    <p class='item-elements'><b>Interiors:</b>         {$interorsArray}</p>
                    <p class='item-elements'><b>Transmission Type:</b> {$item[0]['transmission']}</p>
                    <p class='item-elements'><b>Car Condition:</b>     {$item[0]['car_condition']}</p>
                    <p class='item-elements'><b>Fuel Type:</b>         {$item[0]['fuel_type']}</p>
                    <p class='item-elements'><b>Current price:</b>     {$item[0]['4']}$</p>

                    <a href='tel:{$item[0]['phonenumber']}' class='button'>Call Now</a>
                    <a href='mailto:{$item[0]['email']}' class='button'>Email Now</a>
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
                <button class='button' id="button" onclick="insert_comment()" name='button'>comment</button>
            </div>
        </div>
    </div>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By <a href='/Nova-Auction/pages/about.php'>Humble Ghost Team</a></p>
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
    let item_id = <?php echo $_GET["item_id"]; ?>;
    let logged = <?php echo (checkUserId())? 1 : 0 ?>;
    let comment = document.getElementsByName("user_comment")[0];
    let last_fetch_comments=0;
    let container = document.getElementsByClassName('item-comments')[0];
    let comment_button = document.getElementById('button');


    function visitPage(){
        window.location='register.php';
    }

    if(!logged){
        comment.disabled = true;
        comment_button.onclick = visitPage;
        comment_button.innerHTML= "Sign in"
        comment.placeholder = "You must sign in to comment";
    }
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
                    node.style = 'text-align: left; justify-self:flex-start;  background-color:#eeeeeeb6';
                }
                else {
                    node.style = 'text-align: right; justify-self:flex-end;  color:white; background-color:#007f5fc7';
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
            if(logged){
            comment.disabled = false;
        }
        }
            
        })
        .catch(error => {
            
        });
        
        // get_comment();
        
    }
    get_comment();
    setInterval(get_comment,5000);
</script>
</html>