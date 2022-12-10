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

$r = "INSERT INTO user_info VALUES
(default,'$fn','$ln','$email','$pass','$tele')";

$sql="SELECT * from user_info where email='$email'";

$res=mysqli_query($conn,$sql);

if (mysqli_num_rows($res) > 0){
  $row = mysqli_fetch_assoc($res);

  if($email==isset($row['email']))
  {
        echo "email already exists";
  }else{
    mysqli_query($conn, $r);
    header('Location: /Nova-Auction/');
  }
}else{
   mysqli_query($conn, $r);
   header('Location: /Nova-Auction/');
}


  
?>