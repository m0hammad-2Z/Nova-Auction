<?php
// init PHP
require "../lib.php"; 

checkUserId();

if(!isset($_SESSION['user_id'])){
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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
</head>
<body>
<?php 
        printNav();
    ?>

    
     <div class='main'>
        <div class='search-options'>
            <form class='search-form' action='' method='post' enctype="multipart/form-data">
                <div class='item-info'>
                    <label for='product-name'>Product Name</label>
                    <input type='text' name='product_name' id='product-name'>
                    
                    <label for='product-name'>Product Descreption</label>
                    <input type='text' name='product_des' id='product-name'>

                    <label for='photo-upload'>Upload Photo</label>
                    <input id='fileupload' type='file' name='image' multiple=''>

                </div>
               
                <div class='item-details'>
                    <select  name='cities' id='cities'>
                        <option  value='0'>City</option>
                        <?php 
                        $res = Database("select concat(upper(substring(city_name,1,1)),lower(substring(city_name,2))) from city",1);
                            foreach($res as $row){
                                print("<option value='$row[0]'>$row[0]</option>");
                            }
                        
                        ?>
                    </select>

                    <select onchange='getSelected()' name='car_mekes' id='car-mekes'>
                        <option value='0'>Car makes</option>
                        <?php 
                        $res = Database("select upper(makes_name) from car_info group by makes_name",1);
                            foreach($res as $row){
                                print("<option value='$row[0]'>$row[0]</option>");
                            }
                        
                        ?>
                    </select>

                    <select name='model' id='model' disabled>
                        <option value='0'>Model</option>
                    </select>

                    <input type="number" min="1" name='price' placeholder='Price'>

                    <input type="number" min="1900" max="2023" step="1" name='year' placeholder='Year'>

                </div>
                <button class='button' name="submit_button" type='submit'>Submit</button>
            </form>

            <?php
            
            if(isset($_POST['submit_button'])){
                Database("insert into cars values(default,'{$_POST['car_mekes']}','{$_POST['model']}', {$_POST['year']})", 0);
                $filename = $_FILES["image"]["name"];
                $tempname = $_FILES["image"]["tmp_name"];  
                $folder = "../user_images/" . $_SESSION['user_id'].(Database("select max(id) from items",1)[0][0]+1).".".explode("/",$_FILES["image"]["type"])[1];
                $car_id = Database("select max(id) from cars",1)[0][0];
                // echo $car_id . "<br>";
                move_uploaded_file($tempname, $folder);
                // echo "insert into items values(default,'{$_POST['product_name']}','{$_POST['product_des']}', '$folder', 2005000,{$_SESSION['user_id']},$car_id)" . "<br>";
                Database("insert into items values(default,'{$_POST['product_name']}','{$_POST['product_des']}', '$folder', {$_POST['price']},{$_SESSION['user_id']},$car_id)", 0);
                echo "<span class='register_error'>Item added</span>";
            }

            ?>

        </div>     
    </div>
<?php 

?>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
<script>
var CarArr = <?php
echo json_encode(Database("select upper(makes_name) , upper(model_name) from car_info order by model_name asc",1,MYSQLI_NUM));
?>;


function getSelected(){
    var seleted = document.getElementById('car-mekes').value; 
    var model = document.getElementById('model');
    console.log(seleted);
    if(seleted == '0'){
        model.disabled = true;
        return;
    }
    
    
    while (model.lastChild) {
        if(model.lastChild.value == 0)
            break;
        model.removeChild(model.lastChild);
    }

    for(var i = 0; i<CarArr.length;++i){
        if(CarArr[i][0]==seleted)
        {
            var node = document.createElement("option");
            node.value = CarArr[i][1];
            node.innerHTML = CarArr[i][1];
            model.appendChild(node);
        }
    }
   model.disabled = false;
}



    


function hi(){
    console.log("hi bitch");
}


</script>
</html>