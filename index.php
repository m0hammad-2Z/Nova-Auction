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
    <script src="Recommendation.js"></script>

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
        <div class='cards-grid' id='cards-grid'>
               
        
    </div>
    <a class='button' href='/Nova-Auction/pages/products.php'>View More!</a>
    <footer class='footer'>
        <p>Copyright © 2022 Nova | Design By <a href='/Nova-Auction/pages/about.php'>Humble Ghost Team</a></p>
        
    <?php
        $carsRes =  Database('Select cars.id, cars.makes_name, cars.model_name, cars.color, items.price, cars.year_of_make, items.name, items.img_path, items.id from cars, items where items.car_id = cars.id order by cars.id DESC', 1, MYSQLI_NUM);
        foreach($carsRes as $key => $value)
        if(count(explode(",",$carsRes[$key][7]))>1){
            $carsRes[$key][7] = explode(",",$carsRes[$key][7])[0];
        }
        $carsJson = json_encode($carsRes);
        echo "<script>var carsData = " . $carsJson . ";</script>";
        
        if(checkUserId()){
            $userRes = Database("Select car_id from view_history where user_id = {$_SESSION['user_id']} order by id DESC limit 5", 1, MYSQLI_NUM);
            $userJson = json_encode($userRes);
            echo "<script>var userData = " . $userJson . ";</script>";
        }else{
            $userRes = Database("Select car_id from view_history order by id DESC limit 10", 1, MYSQLI_NUM);
            $userJson = json_encode($userRes);
            echo "<script>var userData = " . $userJson . ";</script>";
        }

    ?>
    </footer>

</body>
<script defer>   
const cars = carsData;
let car_history_ids = userData;

for(let k = 0; k < 6; k++){
    CreateSuggestionCard(cars[k][6], cars[k][4], cars[k][7], cars[k][8], false);
}

//In case no car history data
const randomNumber = [];
for(let i = 0; i < 10; i++){
    randomNumber.push([(Math.floor((Math.random() * 90) + 10)).toString()]);
}
if(car_history_ids.length == 0) car_history_ids = randomNumber;

const updatedCars = new Map();



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
        if(index < 6){
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
        card.appendChild(text);
        
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