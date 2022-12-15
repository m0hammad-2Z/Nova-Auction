<?php
// init PHP
require "./lib.php";
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
</head>

<body>
    <?php
    printNav();
    ?>
    <div class='main'>
        <img class='home-img' src='img/cars-home.jpg' alt='Home page'>
        <div class='home-img-text'>
            <span>Welcome To Nova Auction</span>
            <h2>Purchase Dream Product & Try.</h2>
            <p>Nulla facilisi. Maecenas ac tellus ut ligula interdum convallis. <br> Nullam dapibus on erat in dolor posuere, none hendrerit lectus ornare. <br> Suspendisse sit amet turpina sagittis, ultrices dui et, aliquam none hendrerit lectus. </p>
            <a href='#home-body' class='button'>Start Bidding</a>
        </div>
    </div>
    <div class='home-body' id='home-body'>
        <h1>Best Items</h1>
        <p>Explore on the world"s best & largest Bidding marketplace with our beautiful Bidding products. <br> We want to be a part of your smile, success and future growth. </p>
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
                <span style='font-size:25px ;'><?php echo $name; ?></span>
                <br>
                <span>Price: <bold><?php echo $price; ?>$</bold>
                </span>
                <br>
                <a href='/Nova-Auction/pages/item.php?item_id=<?php echo $item_id?>' ><button class='button b_card' >Buy</button></a>
            </div>

        <?php  }?>

        </div>
        <button class='button'>View more!</button>
    </div>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>

</html>