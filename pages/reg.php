<?php 
extract($_POST);

$conn = new mysqli("localhost","root", "12345678","nova_auction");
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
    }

$q = "INSERT INTO user_info VALUES
(default,'$fn','$ln','$email','$pass','$tele')";

if (mysqli_query($conn, $q)) {
    echo "successfully";
  } else {
    echo "Error: " . $q . "<br>" . mysqli_error($conn);
  }
?>