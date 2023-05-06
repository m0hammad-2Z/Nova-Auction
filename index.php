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
        <div class='cards-grid' id='cards-grid'>
               
        
    </div>
    <a class='button' href='/Nova-Auction/pages/products.php'>View More!</a>
    <footer class='footer'>
        <p>Copyright © 2022 Nova | Design By Humble Ghost Team</p>
        
    <?php
         $carsRes =  Database('Select cars.id, cars.makes_name, cars.model_name, cars.color, items.price, cars.year_of_make, items.name, items.img_path, items.id from cars, items where items.car_id = cars.id', 1, MYSQLI_NUM);
         $carsJson = json_encode($carsRes);
         echo "<script>var carsData = " . $carsJson . ";</script>";
        
        if(checkUserId()){
            $userRes = Database("Select car_id from view_history where user_id = {$_SESSION['user_id']} order by id DESC limit 4", 1, MYSQLI_NUM);
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
<script>   
const cars = carsData;
const car_history_ids = userData;

if(car_history_ids.length == 0) car_history_ids(55)
const updatedCars = new Map();
// console.log(carsData)
// console.log(car_history_ids)


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
for (let i of car_history_ids) {
    const l = updatedCars.get(i[0]);
    for (let d = 0; d < numberOfElementsInCars; d++) {
        userVector[d] += l[d];
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
    if(index < 30){
        for(let car of cars){
        if(car[0] == k){
            CreateSuggestionCard(car[6], car[4], car[7], car[8]);
            index++;
        }
    }
    }
});


function EuclideanSimilarity(vector1, vector2) {
    let res = 0.0;
    let sum = 0;
    for (let i = 0; i < vector1.length; i++) {
        const diff = vector1[i] - parseFloat(vector2[i]);
        sum += diff ** 2;
    }

    res = Math.sqrt(sum);
    return res;
}

function unqList(daList, nominalIndexes) {
    const map = new Map();
    const res = [];
    for (let i of nominalIndexes) {
        for (let l of daList) {
            map.set(l[i], i);
        }
    }

    map.forEach((value, key) => {
        res.push(key);
    });

    return res;
}

function OneShotEncoding(list, uniqueList) {
    const res = [];
    for (let l of uniqueList) {
        if (list.includes(l)) {
            res.push(1.0);
        } else {
            res.push(0.0);
        }
    }

    return res;
}

function minMax(list, numaricIndexes) {
    const res = [];

    for (const i of numaricIndexes) {
        let min = Number.MAX_VALUE;
        let max = Number.MIN_VALUE;

        // find the min and the max
        for (const row of cars) {
            const num = parseFloat(row[i]);
            if (num < min) {
                min = num;
            }
            if (num > max) {
                max = num;
            }
        }

        // Calculation
        for (let j = 0; j < list.length; j++) {
            if (i === j) {
                res.push((parseFloat(list[i]) - min) / (max - min));
            }
        }
    }

    return res;
}


function CreateSuggestionCard(nameText, priceText, imgPath, itemId){
    const cardsGrid = document.getElementById("cards-grid");


    const card = document.createElement('div');
    card.classList.add('card');
    
    const image = document.createElement('img');
    image.setAttribute('src', imgPath);
    
    const name = document.createElement('span');
    name.setAttribute('id', 'name');
    name.innerText = nameText;

    
    const price = document.createElement('span');
    price.innerText = priceText;
    
    const link = document.createElement('a');
    const button = document.createElement('button');
    button.classList.add('button', 'b_card');
    link.setAttribute('href', '/Nova-Auction/pages/item.php?item_id=' + itemId);
    link.appendChild(button);
    
    card.appendChild(image);
    card.appendChild(name);
    card.appendChild(price);
    card.appendChild(link);

    cardsGrid.appendChild(card);
    
}



</script>
</html>