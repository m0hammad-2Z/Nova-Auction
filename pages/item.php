<?php
// init PHP
require_once "../lib.php"; 
if(!isset($_GET["item_id"]) || !is_numeric($_GET["item_id"])||  count(Database("select id from items where id = {$_GET['item_id']}", 1)) <= 0){
    header("Location: /Nova-Auction/pages/error.php"); 
}

$item = Database("select * from items,cars,user_info where items.id = {$_GET["item_id"]} and user_info.id = (select user_id from items where items.id = {$_GET["item_id"]}) and cars.id = (select car_id from items where items.id = {$_GET["item_id"]})",1);

if(checkUserId())
Database("delete from notifications where item_id = {$_GET["item_id"]} and user_id = {$_SESSION["user_id"]} and (readed = 0 or readed = 1)", 0);

    // foreach($notifications as $n){
    //     Database("UPDATE notifications SET readed = 1 where id = $n[id]", 0);
    // }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item[0]['name']; ?></title>
    <link rel="icon" type="image/png" href="/Nova-Auction/img/fav.png">
    <link rel="stylesheet" href="/Nova-Auction/css/styles.css">
    <link rel="stylesheet" href="/Nova-Auction/css/item.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../Recommendation.js"></script>
</head>
<body>
    <?php
    printNav();
    ?>

    
    <div class="main">

            <?php 
                 $imgArr = explode(",",$item[0][3]);
                if(explode("/",$imgArr[0])[0] == "user_images"){
                    $imgArr[0] = "/Nova-Auction/".$imgArr[0];
                }
                if(isset($_SESSION["user_id"]) && count(Database("select user_id,car_id from view_history where user_id = {$_SESSION['user_id']} and car_id = {$item[0]['car_id']}",1,MYSQLI_NUM)) == 0){
                    Database("insert into view_history values(default,{$_SESSION['user_id']},{$item[0]['car_id']},{$item[0]['price']})",0);
                }
            ?>

        
            <div class="left-container">
            <div class="item-pic container">
                <div class="main-pic">
                    <img id="blurred" src=<?php echo $imgArr[0] ?> alt=''>
                    <img id="main-image" src=<?php echo $imgArr[0] ?> alt=''>
                </div>

                <?php 

                    if(count($imgArr)>1){
                        echo "<div class='side-pics', id='side-pics'>";
                        foreach($imgArr as $key => $value){
                            if(explode("/",$value)[0] == "user_images"){
                                $value= "/Nova-Auction/".$value;
                            }
                            print("<img id='im' src='$value' onclick='changeImg(\"$value\")' alt=''>");
                        }
                        echo "</div>";
                    }
                ?>

            </div>
                    <div class="info container">

                        <?php
                           $user_img = $item[0]['img_path'];
                           $isLink = substr($user_img, 0, 5) === 'http:' || substr($user_img, 0, 5) === 'https' ? True : False;

                           if($isLink){
                               $user_img = $user_img;
                           }else if ($user_img == NULL){
                               $user_img = 'https://api.dicebear.com/6.x/initials/png?seed=' . rand(1, 5000);
                           }else{
                               $user_img = '../' . $user_img;
                           }
                        
                        ?>

                        <div class="user-info">
                        <img src='<?php echo  $user_img;?>'alt="" width = 70px height =70px>
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
                        <p class= 'price'>{$item[0][4]} $</p>
                        
                        
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
                            <td class='value'>{$item[0]['interiors']}</td>
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
                            <a href='tel:{$item[0]['phonenumber']}' class='button' onclick='insert_call_notification();'>Call Now</a>
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
        
    
        <div class='item-comment-container container'>
            <h1>Comment</h1>
            <div class='item-comments'></div>
            <div class='comment-form'>
                <input type="text" name="user_comment" placeholder="Your comment...">
                <button class='button' id="button" onclick="insert_comment()" name='button'>comment</button>
            </div>
        </div>
    </div>
    </div>

    <div class="Suggestions">
        <h1>Suggested Item</h1>
        <hr class="divider">
        <div class='cards-grid' id='cards-grid'>
        </div>
    </div>
   
    <footer class="footer">
        <p>Copyright &copy; 2022 Nova Auction | Design By <a href='/Nova-Auction/pages/about.php'>Humble Ghost Team</a></p>
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
    let user_id = <?php echo $item[0]["user_id"]; ?>;
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
            body: JSON.stringify({choose:0 , user_comment:comment.value,item_id:item_id, user_id:user_id})
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


    async function insert_call_notification(){
        await fetch('notificationsM.php', {
            method: 'post',
            body: JSON.stringify({clickOnPhone: true, user_id:user_id, item_id:item_id})
    });
}

    

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


<?php
    $carsRes =  Database('Select cars.id, cars.makes_name, cars.model_name, cars.color, items.price, cars.year_of_make, items.name, items.img_path, items.id from cars, items where items.car_id = cars.id order by cars.id DESC', 1, MYSQLI_NUM);
    foreach($carsRes as $key => $value)
    if(count(explode(",",$carsRes[$key][7]))>1){
        $carsRes[$key][7] = explode(",",$carsRes[$key][7])[0];
    }
    $carsJson = json_encode($carsRes);
    echo "<script>var carsData = " . $carsJson . ";</script>";

    $userRes = Database("Select car_id from items where id = {$_GET['item_id']}", 1, MYSQLI_NUM);
    $userJson = json_encode($userRes);
    echo "<script>var userData = " . $userJson . ";</script>";

?>

<script>
const cars = carsData;
let car_history_ids = userData;



//In case no car history data
const randomNumber = [];
for(let i = 0; i < 1; i++){
    randomNumber.push([(Math.floor((Math.random() * 90) + 10)).toString()]);
}
if(car_history_ids.length == 0) car_history_ids = randomNumber;

const updatedCars = new Map();

console.log(cars)
console.log(car_history_ids)

const nominalFeatureIndex = [1, 2, 3];
const numaricFeatureIndex = [4, 5];
let numberOfElementsInCars = 0;

const uniqueList = unqList(cars, nominalFeatureIndex);

for (let l of cars) {
    const key = l[0];
    const l1 = minMax(l, numaricFeatureIndex);
    const l2 = OneShotEncoding(l, uniqueList);
    const fl = l1.concat(l2);
    numberOfElementsInCars = fl.length;
    updatedCars.set(key, fl);
}


const userVector = new Array(numberOfElementsInCars).fill(0);
for (let carId of car_history_ids) {
    const car = updatedCars.get(carId[0]);
    if(car != null)
    for (let elementIndex = 0; elementIndex < numberOfElementsInCars; elementIndex++) {
        userVector[elementIndex] += car[elementIndex];
    }
}
for (let k = 0; k < numberOfElementsInCars; k++) {
    userVector[k] /= car_history_ids.length;
}

//Calculate similarity
const finalList = new Map();
updatedCars.forEach((v, k) => {
    const similarity = EuclideanSimilarity(userVector, v);
    finalList.set(similarity, k);
});

//Sort
const sortedByKey = new Map(
    Array.from(finalList).sort((a, b) => a[0] > b[0] ? 1 : -1)
);



let index = 0;
sortedByKey.forEach((k, v) => {
        if(index < 8){
            for(let car of cars){
                let matchFound = false;
                for(let i = 0; i < car_history_ids.length; i++)
                {             
                    if(car_history_ids[i] == car[0]){
                        matchFound = true;
                        break; 
                    }
                }

                if(car[0] == k && !matchFound){
                    CreateSuggestionCard(car[6], car[4], car[7], car[8], true);
                    index++;
                    break;
                } 
            }
        
        }
});


    function CreateSuggestionCard(nameText, priceText, imgPath, itemId, isRecommended){
        const cardsGrid = document.getElementById("cards-grid");
    
    
        const card = document.createElement('div');
        card.classList.add('card');
        
        const image = document.createElement('img');
        image.setAttribute('src', imgPath);
    
    
        const text = document.createElement('span');
        if(isRecommended){
            text.classList.add('recommended-tag');
            text.innerText = "Recommended";
        }else{
            text.classList.add('new-tag');
            text.innerText = "Newly Added";
        }
        // card.appendChild(text);
        
        const br = document.createElement("br");
    
        const name = document.createElement('span');
        name.setAttribute('id', 'name');
        name.innerText = nameText;
    
        
        const price = document.createElement('span');
        price.innerText = "Price: "+priceText+"$";
        price.id="price";
        const link = document.createElement('a');
        // const button = document.createElement('button');
        // button.classList.add('button', 'b_card');
        // if(!isRecommended){
        //     button.style.color = "#00377f";
        //     button.style.border = "3px solid #00377f";
        // }else{
        //     button.style.color = "var(--color)";
        // }
        
        link.setAttribute('href', '/Nova-Auction/pages/item.php?item_id=' + itemId);
        // link.appendChild(button);
        
        card.appendChild(image);
        card.appendChild(name);
        card.appendChild(br);
        card.appendChild(price);
        link.appendChild(card);
    
        cardsGrid.appendChild(link);
    }

</script>
</html>