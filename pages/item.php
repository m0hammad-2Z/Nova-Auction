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
    <title>Account</title>
    <link rel="stylesheet" href="/Nova-Auction/css/styles.css">
    <link rel="stylesheet" href="/Nova-Auction/css/auction.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php
    printNav();
    ?>

    
    <div class="main">

            <?php 
                if(!isset($_GET["item_id"]) ||  count(Database("select id from items where id = {$_GET['item_id']}", 1)) <= 0){
                    header("Location: /Nova-Auction/pages/products.php"); 
                }

                $item = Database("select * from items,cars,user_info where items.id = {$_GET["item_id"]} and user_info.id = (select user_id from items where items.id = {$_GET["item_id"]}) and cars.id = (select car_id from items where items.id = {$_GET["item_id"]})",1);
                
                if(count(Database("select user_id,car_id from view_history where user_id = {$_SESSION['user_id']} and car_id = {$item[0]['car_id']}",1,MYSQLI_NUM)) == 0)
                    Database("insert into view_history values(default,{$_SESSION['user_id']},{$item[0]['car_id']})",0);

                $interorsArray = '';

                foreach(unserialize($item[0]['interiors']) as $int){
                    $interorsArray .= ucfirst($int) . ", ";
                }
                $interorsArray = substr_replace($interorsArray, "", -2);

            ?>

        
            <div class="left-container">
            <div class="item-pic container">
                <div class="main-pic">
                    <img id="blurred" src=<?php echo "../".$item[0][3]; ?> alt=''>
                    <img id="main-image" src=<?php echo "../".$item[0][3]; ?> alt=''>
                </div>

                <div class="side-pics", id="side-pics">
                    <img id="im" src=<?php echo "../".$item[0][3]; ?> onclick="changeImg('<?php echo '../'.$item[0][3]; ?>')" alt=''>
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                    <img id='im' src="https://picsum.photos/100" onclick="changeImg('https://picsum.photos/100')" alt="">
                </div>

            </div>
                    <div class="info container">

                        <div class="user-info">
                        <img src="https://picsum.photos/100?b" alt="">
                        <span><a href=<?php echo "user.php?user_id=".$item[0]['id']?>> <?php echo $item[0]['first_name']." ".$item[0]['last_name'];?></a></span>
                        </div>
                        <h1>Description</h1>
                        <p>
                        <?php echo $item[0][2];?>
                        </p>
                    </div>
                    
            </div>
            <div class="right-container">

            <div class="bid container">


                <div class="main-bid">
                    <?php
                        print("
                        <p class= 'price'>{$item[0]['4']} $</p>
                        
                        
                        <table>
                        <tr>
                            <td class='label'><b>Car Model:</b></td>
                            <td class='value'>{$item[0][9]} {$item[0][10]} {$item[0][11]}</td>
                        </tr>
                        <tr>
                            <td class='label'><b>Location:</b></td>
                            <td class='value'>{$item[0][7]}</td>
                        </tr>
                        <tr>
                            <td class='label'><b>Car Color:</b></td>
                            <td class='value'>{$item[0]['color']}</td>
                        </tr>
                        <tr>
                            <td class='label'><b>Interiors:</b></td>
                            <td class='value'>{$interorsArray}</td>
                        </tr>
                        <tr>
                            <td class='label'><b>Transmission Type:</b></td>
                            <td class='value'>{$item[0]['transmission']}</td>
                        </tr>
                        <tr>
                            <td class='label'><b>Car Condition:</b></td>
                            <td class='value'>{$item[0]['car_condition']}</td>
                        </tr>
                        <tr>
                            <td class='label'><b>Fuel Type:</b></td>
                            <td class='value'>{$item[0]['fuel_type']}</td>
                        </tr>
                        </table>
                        <div class='btns'>
                            <h2>{$item[0][9]}</h2>
                            <a href='tel:{$item[0]['phonenumber']}' class='button'>Call Now</a>
                            <a href='mailto:{$item[0]['email']}' class='button'>Email Now</a>
                    </div>
                        ");
                        
                    
                    ?>
            </div>

            <!-- <div class="last-bid">
                <h2>Last bidders</h2>
                <div class="last-bid-info">
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>

            
                </div>
            </div> -->
        </div>
        
    
        <div class='item-comment-container'>
            <h1>Comment</h1>
            <div class='item-comments'></div>
            <div class='comment-form'>
                <input type="text" name="user_comment" placeholder="Your comment...">
                <button class='button' id="button" onclick="insert_comment()" name='button'>comment</button>
            </div>
        </div>
    </div>
    </div>
   
    <footer class="footer">
        <p>Copyright &copy; 2022 Nova Auction | Design By Humble Ghost Team</p>
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
                    node.style = 'text-align: right; justify-self:flex-end; color:white; background-color:#007f5fc7';
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

<script>
    function changeImg(imgSrc){
        console.log(imgSrc);
        var mainImg = document.getElementById("main-image");
        mainImg.src=imgSrc;
        // mainImg.style = 
    }

    var myImage = document.getElementById('side-pics').children;

    for(var i = 0; i < myImage.length;i++){
        myImage[i].addEventListener('mousedown', function(event) {
            event.preventDefault();
        });

        myImage[i].addEventListener('dragstart', function(event) {
            event.preventDefault();
        });
    }


        
</script>
</html>