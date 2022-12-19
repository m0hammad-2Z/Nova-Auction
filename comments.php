<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script type="module" src="comments.js"></script> -->
    <title>Document</title>
</head>
<body>
    <button id="pst">post</button>
</body>
</html>

<?php
$jsonArray = 
    [
        "id" => "2",
        "title" => "Shazam!",
        "poster" => "https://image.tmdb.org/t/p/w500/xnopI5Xtky18MPhK40cZAGAOVeV.jpg",
        "overview" => "A boy is given the ability to become an adult superhero in times of need with a single magic word.",
        "release_date" => "1553299200",
        "genres"=> ["Action", "Comedy", "Fantasy"]
    ],
    [
        "id" => "fdsa",
        "title" => "fdsafdas",
        "poster" => "dsa",
        "overview" => "DSA between two alien races. Set in the 1990s, Captain Marvel is an all-new adventure from a previously unseen period in the history of the Marvel Cinematic Universe.",
        "release_date" => "1551830400",
        "genres"=> ["Action", "Adventure", "Science Fiction"]
    ];

$jsonString = json_encode($jsonArray, JSON_PRETTY_PRINT);
// Write in the file
$fp = fopen('comments.js', 'w');
$jsonData = json_decode($jsonString, true);
fwrite($fp, $jsonData.$jsonString);
fclose($fp);

?>