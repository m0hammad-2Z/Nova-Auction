<?php
// init PHP
require_once "../lib.php";

if (!checkUserId()) {
    header("Location: /Nova-Auction/pages/register.php");
}
if (isset($_POST['submit_button'])) {

    if (!checkUserId()) {
        header("Location: /Nova-Auction/pages/register.php");
    } else {
        if (isset($_POST['interior'])) {
            $selected_interiores ="";
            foreach( $_POST['interior'] as $key => $interior ){
                if($key == count($_POST['interior']) - 1)
                    $selected_interiores .= $interior;
                else
                    $selected_interiores .= $interior.", ";
            }
        } else {
            $selected_interiores = 'No Interiors Added';
        }

        Database("insert into cars values(default,'{$_POST['car_mekes']}','{$_POST['model']}', '{$_POST['year']}', '{$_POST['color']}', '$selected_interiores', '{$_POST['transmission']}', '{$_POST['car-condition']}', '{$_POST['fuel']}')", 0);
        $car_id = Database("select max(id) from cars", 1)[0][0];
        $item_id = (Database("select max(id) from items", 1)[0][0] + 1);
        $folder="";
        for($i = 0,$counter = 1;$i<count($_FILES["image"]["name"]);++$i){
        if($i == $_POST["primaryimageindex"]){
            
            $filename = $_FILES["image"]["name"][$i]."_"."0";
            $tempname = $_FILES["image"]["tmp_name"][$i];
            if($i == count($_FILES["image"]["name"])-1){
                $folder = "user_images/" ."0"."_". $_SESSION['user_id'] . $item_id . "." . explode("/", $_FILES["image"]["type"][$i])[1] .",". $folder;

            }else{
                $folder = "user_images/" ."0"."_". $_SESSION['user_id'] . $item_id . "." . explode("/", $_FILES["image"]["type"][$i])[1].",". $folder;
            }
            move_uploaded_file($tempname, ("../" . "user_images/" ."0"."_". $_SESSION['user_id'] . $item_id . "." . explode("/", $_FILES["image"]["type"][$i])[1]));

        }
        else{
            $filename = $_FILES["image"]["name"][$i]."_".($counter);
            $tempname = $_FILES["image"]["tmp_name"][$i];
            if($i == count($_FILES["image"]["name"])-1){
                $folder .= "user_images/" .$counter."_". $_SESSION['user_id'] . $item_id . "." . explode("/", $_FILES["image"]["type"][$i])[1];

            }else{
                $folder .= "user_images/" .$counter."_". $_SESSION['user_id'] . $item_id . "." . explode("/", $_FILES["image"]["type"][$i])[1].",";
            }
            move_uploaded_file($tempname, ("../" . "user_images/" .$counter."_". $_SESSION['user_id'] . $item_id . "." . explode("/", $_FILES["image"]["type"][$i])[1]));
            $counter++;
        }
        // echo $car_id . "<br>";
    }
        // echo "insert into items values(default,'{$_POST['product_name']}','{$_POST['product_des']}', '$folder', 2005000,{$_SESSION['user_id']},$car_id)" . "<br>";
        Database("insert into items values(default,'{$_POST['product_name']}','{$_POST['product_des']}', '$folder', {$_POST['price']},{$_SESSION['user_id']},$car_id,'{$_POST['city']}')", 0);
        $item_id = (Database("select max(id) from items", 1)[0][0]);
        header("Location: /Nova-Auction/pages/item.php?item_id=".$item_id);
    }
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
            <input type="hidden" id="primaryimageindex" name="primaryimageindex" value="0">
            <div class="left-side">
                <div class='search-options'>

                    <div class='item-info'>
                        <label for='product-name'>Product Name</label>
                        <input type='text' name='product_name' id='product-name' maxlength="20" required>

                        <label for='product-des'>Product Descreption</label>
                        <textarea rows="5" cols="60" name='product_des' id='product-des' required></textarea>
                        <div class="image-preview-container">
                        <!-- <div class="imgContainer primary">
                            <img id="uploadPreview" src="">
                        </div> -->
                        </div>
                        <input id='photo-upload' onchange='uploadPreviewfun()' type='file' name='image[]' accept="image/*" multiple required>
                        <label for='photo-upload'>Upload Photo</label>

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

                   

                    ?>

                </div>
            </div>

            <div class="right-side">
                <div class="colors-section">
                    <h2>What Is Your Car Color?</h2>
                    <div class="color-container">
                        <input type="radio" class="color-choose" name="color" value="black" id="black" required>
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
                        <input type="checkbox" name="interior[]" id="usb" value="usb">
                        <label for="usb">USB</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior[]" id="aux" value="aux">
                        <label for="aux">AUX</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior[]" id="alarm" value="alarm">
                        <label for="alarm">Alarm</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior[]" id="cdplayer" value="cdplayer">
                        <label for="cdplayer">Cd Player</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior[]" id="bluetooth" value="bluetooth">
                        <label for="bluetooth">Bluetooth</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior[]" id="touch-screen" value="touch-screen">
                        <label for="touch-screen">Touch Screen</label>
                    </div>
                    <div class="interior-option">
                        <input type="checkbox" name="interior[]" id="air-bags" value="air-bags">
                        <label for="air-bags">AirBage</label>
                    </div>

                </div>

                <h2>What is the Transmission type?</h2>
                <div class="transmission-section">
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="transmission" value="Automatic" id="Automatic" required>
                        <label for="Automatic">Automatic</label>
                    </div>
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="transmission" value="Manual" id="Manual">
                        <label for="Manual">Manual</label>
                    </div>
                </div>

                <h2>What type of fuel?</h2>
                <div class="transmission-section">
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="fuel" value="Diesel" id="Diesel" required>
                        <label for="Diesel">Diesel</label>
                    </div>
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="fuel" value="Electric" id="Electric">
                        <label for="Electric">Manual</label>
                    </div>
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="fuel" value="Hybrid" id="Hybrid">
                        <label for="Hybrid">Hybrid</label>
                    </div>
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="fuel" value="Gasoline" id="Gasoline">
                        <label for="Gasoline">Gasoline</label>
                    </div>
                </div>

                <h2>Is the car used?</h2>
                <div class="transmission-section">
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="car-condition" value="New" id="New" required>
                        <label for="New">New</label>
                    </div>
                    <div class="transmission-container">
                        <input type="radio" class="transmission-choose" name="car-condition" value="Used" id="Used">
                        <label for="Used">Used</label>
                    </div>


                </div>
            </div>
        </form>
    </div>

    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By <a href='/Nova-Auction/pages/about.php'>Humble Ghost Team</a></p>
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
    let preview = document.getElementsByClassName("image-preview-container")[0];
    
    function uploadPreviewfun(){
        
        let inputs = document.getElementById("photo-upload");
        if(inputs.files.length > 30){
            alert("30 photos is maximum");
            inputs.value= null;
            return;
        }
        for(let i = 0 ;i<inputs.files.length ;++i){
            let fr = new FileReader();
            fr.readAsDataURL(inputs.files[i]);
            fr.onloadstart = function(e){
                let newPic= document.createElement("div");
                newPic.classList.add("imgContainer");
                newPic.setAttribute("onclick", "makePrimary(this)");
                let newNode = document.createElement("img");
                if(i==0){
                    newPic.classList.add("primary");
                }
                newNode.id="uploadPreview";
                newPic.appendChild(newNode);
                preview.appendChild(newPic);
                fr.onloadend = (e) =>{

                    newNode.src = e.target.result;
                }
                
            }
            
        }
    }

    function makePrimary(cont){
        let containers = document.getElementsByClassName("imgContainer");
        for(var i = 0 ;i<containers.length;++i){
            if(containers[i].classList.contains("primary")){
                containers[i].classList.remove("primary");
                break;
            }
        }
        cont.classList.add("primary");
        for(var i = 0 ;i<containers.length;++i){
            if(containers[i].classList.contains("primary")){
                document.getElementById("primaryimageindex").value = i;
                break;
            }
        }
        
    }
</script>

</html>