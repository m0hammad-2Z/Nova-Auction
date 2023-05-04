<?php
// init PHP
require_once "./lib.php";
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Home</title>
    <link rel='stylesheet' href='css/styles.css'>
    <link rel='stylesheet' href='css/index-style.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
    <link rel="icon" type="image/png" href="img/fav.png" />

</head>

<body>
    <?php
    printNav();
    ?>
    <div class='main'>
        <img class='home-img' src='img/cars-home.jpg' alt='Home page'>
        <div class='home-img-text'>
            <span>Welcome To Nova</span>
            <h2>Purchase Dream Product & Try.</h2>
            <p>Access to the largest possible number of cars of different types. <br> The possibility of selling any car, regardless of its specifications. <br> The possibility of selling any car that had a collision or specific problems. </p>
            <a href='#home-body' class='button'>Explore</a>
        </div>
    </div>
    <div class='home-body' id='home-body'>
        <div class="best-items">
            <h1>Best Items</h1>
            <p>Explore on the world"s best & largest marketplace with our beautiful products. <br> We want to be a part of your smile, success and future growth. </p>
        </div>
        <div class='cards-grid'>
        <?php            
            $res = Database("select name, price, img_path ,id from items order by id DESC limit 6", 1);
            for($i = 0; $i < count($res); $i++) {
                    $name = $res[$i][0];
                    $price = $res[$i][1];
                    $img_p = $res[$i][2];
                    $item_id = $res[$i][3];
        ?>
                <div class='card'>
                <img src="<?php echo $img_p; ?>" alt=''>
                <span id='name'><?php echo $name; ?></span>
                <br>
                <span>Price: <bold><?php echo $price; ?>$</bold>
                </span>
                <br>
                <a href='/Nova-Auction/pages/item.php?item_id=<?php echo $item_id?>' ><button class='button b_card' >View</button></a>
            </div>

        <?php  }?>

        </div>
        <a class='button' href='/Nova-Auction/pages/products.php'>View More!</a>
    </div>
    <footer class='footer'>
        <p>Copyright © 2022 Nova | Design By Humble Ghost Team</p>
    </footer>
</body>

</html>