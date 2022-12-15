<?php
// init PHP
require "../lib.php"; ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Account</title>
    <link rel='stylesheet' href='/Nova-Auction/css/styles.css'>
    <link rel='stylesheet' href='/Nova-Auction/css/products.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
</head>

<body>
    <?php printNav(); ?>

    <div class='main'>
        <div class='search-options'>
            <form class='search-form' action='' method='post'>
                <select name='cities' id='cities'>
                    <option value='Amman'>City</option>
                    <option value='Irbid'>Amman</option>
                </select>

                <select name='car-mekes' id='car-mekes'>
                    <option value='0'>Car makes</option>
                    <option value='BMW'>BMW</option>
                </select>
                
                <select name='model' id='model'>
                    <option value='0'>Model</option>
                    <option value='BMW'>BMW</option>
                </select>

                <select name='Year-from' id='year-from'>
                    <option value='0'>Year from</option>
                    <option value='BMW'>2000</option>
                </select>

                <select name='Year-To' id='year-to'>
                    <option value='0'>Year to</option>
                    <option value='BMW'>2023</option>
                </select>

                <button class='button' type='submit'>Search</button>
            </form>
        </div>

        <div class='search-details'>
            <p>Showing 1-12 of 24 results</p>
            <select name='Sort' id='sort'>
                <option value='0'>Sort by</option>
                <option value='a-z'>A-Z</option>
            </select>
        </div>

        <div class='cards-grid'>
        <?php            
            $res = Database("select name, price, img_path ,id from items limit 24", 1);
            for($i = 0; $i < count($res); $i++) {
                    $name = $res[$i][0];
                    $price = $res[$i][1];
                    $img_p = "../".$res[$i][2];
                    $item_id = $res[$i][3];
                    if(isset($_POST['button_b_card'])) {
                        echo "<a href='newpage.php'>New Page</a>";
                    }
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

        <div class='page-counter'>
            <button class='button'>1</button>
            <button class='button'>2</button>
            <button class='button'>3</button>
        </div>

    </div>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>

</html>