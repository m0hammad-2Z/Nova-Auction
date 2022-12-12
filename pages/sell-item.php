<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="/Nova-Auction/css/styles.css">
    <link rel="stylesheet" href="/Nova-Auction/css/sell-item.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php 
        require "../lib.php";
        printNav(0);
    ?>

    
     <div class="main">
        <div class="search-options">
            <form class="search-form" action="" method="post">
                <div class="item-info">
                    <label for="product-name">Product Name</label>
                    <input type="text" name="product-name" id="product-name">
                    
                    <label for="product-name">Product Descreption</label>
                    <input type="text" name="product-name" id="product-name">

                    <label for="photo-upload">Upload Photo</label>
                    <input id="fileupload" type="file" name="image" multiple="">

                </div>
                <div class="item-detailt">
                    <select name="cities" id="cities">
                        <option value="Amman">City</option>
                        <option value="Irbid">Amman</option>
                    </select>

                    <select name="car-mekes" id="car-mekes">
                        <option value="0">Car makes</option>
                        <option value="BMW">BMW</option>
                    </select>

                    <select name="Car-type" id="car-type">
                        <option value="0">Car type</option>
                        <option value="BMW">4*4</option>
                    </select>

                    <select name="model" id="model">
                        <option value="0">Model</option>
                        <option value="BMW">BMW</option>
                    </select>

                    <select name="Year-from" id="year-from">
                        <option value="0">Year from</option>
                        <option value="BMW">2000</option>
                    </select>

                    <select name="Year-To" id="year-to">
                        <option value="0">Year to</option>
                        <option value="BMW">2023</option>
                    </select>
                </div>
                <button class="button" type="submit">Submit</button>
            </form>
        </div>     
    </div>

    <footer class="footer">
        <p>Copyright &copy; 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
</html>