<?php
// init PHP
require_once "../lib.php";

if (!checkUserId()) {
    header("Location: /Nova-Auction/pages/register.php");
}


?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Account</title>
    <link rel='stylesheet' href='/Nova-Auction/css/styles.css'>
    <link rel='stylesheet' href='/Nova-Auction/css/sell.css'>
    <link rel="icon" type="image/png" href="/Nova-Auction/img/fav.png">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
</head>

<body>
    <?php
    printNav();
    ?>


    <div class='main'>
        <form class='search-form' method='post' enctype="multipart/form-data">
            <div class="left-side">
                <div class='search-options'>

                    <div class='item-info'>
                        <label for='product-name'>Product Name</label>
                        <input type='text' name='product_name' id='product-name' maxlength="20" required>

                        <label for='product-name'>Product Descreption</label>
                        <textarea rows="5" cols="60" name='product_des' id='product-name' required></textarea>

                        <label for='photo-upload'>Upload Photo</label>
                        <input id='fileupload' type='file' name='image' required>

                    </div>

                    <div class='item-details'>
                        <select name='city' id='city' placehold required>
                            <option value="" disabled selected>City</option>
                            <?php
                            $res = Database("select concat(upper(substring(city_name,1,1)),lower(substring(city_name,2))) from city", 1);
                            foreach ($res as $row) {
                                print("<option value='$row[0]'>$row[0]</option>");
                            }

                            ?>
                        </select>

                        <select onchange='getSelected()' name='car_mekes' id='car-mekes' required>
                            <option value="" disabled selected>Car makes</option>
                            <?php
                            $res = Database("select upper(makes_name) from car_info group by makes_name", 1);
                            foreach ($res as $row) {
                                print("<option value='$row[0]'>$row[0]</option>");
                            }

                            ?>
                        </select>

                        <select name='model' id='model' disabled required>
                            <option value="" disabled selected>Model</option>
                        </select>

                        <input type="number" min="1" name='price' placeholder='Price' required>

                        <input type="number" min="1900" max="2023" step="1" name='year' placeholder='Year' required>

                    </div>
                    <button class='button' name="submit_button" type='submit'>Submit</button>


                    <?php

                    if (isset($_POST['submit_button'])) {

                        if (!checkUserId()) {
                            header("Location: /Nova-Auction/pages/register.php");
                        } else {

                            Database("insert into cars values(default,'{$_POST['car_mekes']}','{$_POST['model']}', {$_POST['year']})", 0);
                            $filename = $_FILES["image"]["name"];
                            $tempname = $_FILES["image"]["tmp_name"];
                            $folder = "user_images/" . $_SESSION['user_id'] . (Database("select max(id) from items", 1)[0][0] + 1) . "." . explode("/", $_FILES["image"]["type"])[1];
                            $car_id = Database("select max(id) from cars", 1)[0][0];
                            // echo $car_id . "<br>";
                            move_uploaded_file($tempname, "../" . $folder);
                            // echo "insert into items values(default,'{$_POST['product_name']}','{$_POST['product_des']}', '$folder', 2005000,{$_SESSION['user_id']},$car_id)" . "<br>";
                            Database("insert into items values(default,'{$_POST['product_name']}','{$_POST['product_des']}', '$folder', {$_POST['price']},{$_SESSION['user_id']},$car_id,'{$_POST['city']}')", 0);
                            echo "<span class='register_error'>Item added</span>";
                        }
                    }

                    ?>

                </div>
            </div>

            <div class="right-side">
               <div class="colors-section">
                    <h2>What Is Your Car Color?</h2>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="black" id="black">
                        <label for="black" style="--choosen-color:rgb(37, 38, 39); --border-color:white"></label>
                    </div>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="red" id="red">
                        <label for="red" style="--choosen-color:rgb(227, 47, 67)"></label>
                    </div>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="bright-green" id="bright-green">
                        <label for="bright-green" style="--choosen-color:rgb(13, 156, 105)"></label>
                    </div>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="dark-blue" id="dark-blue">
                        <label for="dark-blue" style="--choosen-color:rgb(23, 35, 86)"></label>
                    </div>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="white" id="white">
                        <label for="white" style="--choosen-color:white"></label>
                    </div>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="yellow" id="yellow">
                        <label for="yellow" style="--choosen-color:rgb(248, 232, 28)"></label>
                    </div>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="pink" id="pink">
                        <label for="pink" style="--choosen-color:pink"></label>
                    </div>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="cyan" id="cyan">
                        <label for="cyan" style="--choosen-color:rgb(0, 155, 216)"></label>
                    </div>
               </div>
               <h2>What Is Your Car Interiors?</h2>
               <div class="interior-options">
                    
                    <div class="interior-option">
                        <input type="checkbox" name="interior" id="usb">
                        <label for="usb">USB</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior" id="aux">
                        <label for="aux">AUX</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior" id="alarm">
                        <label for="alarm">Alarm</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior" id="cdplayer">
                        <label for="cdplayer">Cd Player</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior" id="bluetooth">
                        <label for="bluetooth">Bluetooth</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior" id="touch-screen">
                        <label for="touch-screen">Touch Screen</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior" id="air-bags">
                        <label for="air-bags">AirBage</label>
                    </div>

               </div>
                
            </div>
        </form>
    </div>
    <?php

    ?>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
<script>
    var CarArr = <?php
    echo json_encode(Database("select upper(makes_name) , upper(model_name) from car_info order by model_name asc", 1, MYSQLI_NUM));
    ?>;


    function getSelected() {
        var seleted = document.getElementById('car-mekes').value;
        var model = document.getElementById('model');
        console.log(seleted);
        if (seleted == '0') {
            model.disabled = true;
            return;
        }


        while (model.lastChild) {
            if (model.lastChild.value == 0)
                break;
            model.removeChild(model.lastChild);
        }

        for (var i = 0; i < CarArr.length; ++i) {
            if (CarArr[i][0] == seleted) {
                var node = document.createElement("option");
                node.value = CarArr[i][1];
                node.innerHTML = CarArr[i][1];
                model.appendChild(node);
            }
        }
        model.disabled = false;
    }

</script>

</html>