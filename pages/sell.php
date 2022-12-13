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
    <link rel='stylesheet' href='/Nova-Auction/css/sell.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
</head>
<body>
<?php 
        printNav();
    ?>

    
     <div class='main'>
        <div class='search-options'>
            <form class='search-form' action='' method='post'>
                <div class='item-info'>
                    <label for='product-name'>Product Name</label>
                    <input type='text' name='product-name' id='product-name'>
                    
                    <label for='product-name'>Product Descreption</label>
                    <input type='text' name='product-name' id='product-name'>

                    <label for='photo-upload'>Upload Photo</label>
                    <input id='fileupload' type='file' name='image' multiple=''>

                </div>
               
                <div class='item-details'>
                    <select  name='cities' id='cities'>
                        <option  value='0'>City</option>
                        <?php 
                        $res = Database("select city_name from city",1);
                            foreach($res as $row){
                                print("<option value='$row[0]'>$row[0]</option>");
                            }
                        
                        ?>
                    </select>

                    <select onchange='getSelected()' name='car-mekes' id='car-mekes'>
                        <option value='0'>Car makes</option>
                        <?php 
                        $res = Database("select makes_name from car_info_makes",1);
                            foreach($res as $row){
                                print("<option value='$row[0]'>$row[0]</option>");
                            }
                        
                        ?>
                    </select>
                        <?php
                      
                        ?>
                    <select name='model' id='model' disabled>
                        <option value='0'>Model</option>
                    </select>

                    <select name='Year-from' id='year-from'>
                        <option value='0'>Year from</option>
                        <option value='BMW'>2000</option>
                    </select>

                    <select name='Year-To' id='year-to'>
                        <option value='0'>Year to</option>
                        <option value='BMW'>2023</option>
                    </select>
                </div>
                <button class='button' type='submit'>Submit</button>
            </form>
        </div>     
    </div>
<?php 

?>
    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
<script>
var makesArr = new Array();
var modelArr = new Array();

<?php
$res =Database("select makes_name , model_name from car_info_makes,car_info_model where makes = car_info_makes.id ",1);
for($i = 0 ; $i<count($res);++$i){
    echo "makesArr[$i]='{$res[$i][0]}';\n";
    echo "modelArr[$i]='{$res[$i][1]}';\n";}
?>
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

    for(var i = 0; i<makesArr.length;++i){
        if(makesArr[i]==seleted)
        {
            var node = document.createElement("option");
            node.value = modelArr[i];
            node.innerHTML = modelArr[i];
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