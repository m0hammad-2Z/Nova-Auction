<?php
// init PHP
require_once "../lib.php"; 

if(!checkUserId()){
    header("Location: /Nova-Auction/pages/register.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="icon" type="image/png" href="/Nova-Auction/img/fav.png">
    <link rel="stylesheet" href="/Nova-Auction/css/styles.css">
    <link rel="stylesheet" href="/Nova-Auction/css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php 
        printNav();
        
    ?>

    
    <div class="main">
        
        <div class="left">
            <h1><?php 

            if(isset($_POST['item-delete-option'])){
                $data = Database("select cars.id, items.img_path from cars, items where items.id = {$_POST['item-delete-option']} and cars.id = (select car_id from items where id = '{$_POST['item-delete-option']}')",1,MYSQLI_ASSOC);
                Database("DELETE FROM comment WHERE item_id = {$_POST['item-delete-option']}", 0);
                Database("DELETE FROM view_history WHERE car_id = {$data[0]['id']}", 0); // from cars
                Database("DELETE FROM items WHERE id = {$_POST['item-delete-option']}", 0);
                Database("DELETE FROM cars WHERE id = {$data[0]['id']}", 0); // from cars

                #delete the image
                $imgArr =explode(",", $data[0]['img_path']);
        
                
                foreach($imgArr as $key => $value){
                    if(explode("/",$value)[0] == "user_images"){
                        $value=  $_SERVER['DOCUMENT_ROOT']."/Nova-Auction/".$value;
                    }
                    if (file_exists($value)) {
                        unlink($value);
                    }
                }
               
            }
            $user_info = Database("select * from user_info where id = '".$_SESSION['user_id']."'",1);
            echo 'Hello, '.$user_info[0]['first_name']." ".$user_info[0]['last_name'];
            ?></h1>
            <a class="active-page" href="">Your Cars</a>
            <a href='/Nova-Auction/pages/register.php'>Logout</a>
        </div>

        <?php
            $res = Database("SELECT * FROM items WHERE user_id = '".$_SESSION['user_id']."'", 1);  
            if(count($res) > 0){        
        ?>
        <div class="users-items">
            <div class="text-title">
                <h1>Items</h1>
                <hr class="divider">
            </div>

            <?php
                for($i = 0; $i < count($res); $i++) {
                    $name = $res[$i]['name'];
                    $img_p = $res[$i]['img_path'];
                    if(count(explode(",",$img_p))>1){
                        $img_p = explode(",",$img_p)[0];
                    }
                    if(explode("/",$img_p)[0] == "user_images"){
                        $img_p = "/Nova-Auction/".$img_p;
                    }
                    $item_id = $res[$i]['id'];
                ?>

                <div class="item">
                    <img src="<?php echo $img_p;?>">
                    <h3><?php echo $name;?></h3>
                    <div class="item-options">
                        <a href='/Nova-Auction/pages/item.php?item_id=<?php echo $item_id?>'>Select</a>
                        <form method="post">
                            <button value="<?php echo $item_id?>" class="item-delete-option" name="item-delete-option">Delete</button>
                        </form>
                    </div>
                </div>

                <?php     
                    }
                    
                }else{
                    print("<div class='users-items-no-items'>
                            <i class='fa fa-gears'></i>
                            <h3>You Have Not Post Any Car Yet!</h3>
                            <a class = 'button' href='/Nova-Auction/pages/sell.php'>Post A Car Now</a>
                        </div>    
                    ");
                }
                ?>

                
        </div>

    </div>

    <footer class="footer">
        <p>Copyright &copy; 2022 Nova Auction | Design By <a href='/Nova-Auction/pages/about.php'>Humble Ghost Team</a></p>
    </footer>
</body>
</html>