<?php 
extract($_POST);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nova_auction";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


$l = "SELECT email, pass from user_info where email='$email' and pass='$pass'";

$res = mysqli_query($conn,$l);


    if (mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);


    if($email==isset($row['email']) and $pass==isset($row['pass'])){
        mysqli_query($conn,$l);
        header('Location: /Nova-Auction/');
        echo "login";

    }else{
        echo "Error in email or password 0";
    }
   }
   else{
    echo "Error in email or password 1";

   }
?>