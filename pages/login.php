<?php 
session_start();
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

if(!isset($_SESSION['login_user'])){

    if (mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);


    if($email==isset($row['email']) and $pass==isset($row['pass'])){
        mysqli_query($conn,$l);

        $_SESSION['login_user'] = $email;
        $_SESSION['pass'] = $pass;

        //header('Location: /Nova-Auction/');
        echo $_SESSION['login_user'];

    }else{
        echo "Error in email or password 0";
    }
   }
   else{
    echo "Error in email or password 1";
   }
}else{
    mysqli_query($conn,"SELECT email, pass from user_info where email='".$_SESSION['login_user']."' and pass='".$_SESSION['pass']."'");
    echo "session";

}
?>