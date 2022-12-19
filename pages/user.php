<?php
// init PHP
require "../lib.php"; 

if(!checkUserId()){
    header("Location: /Nova-Auction/pages/register.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="/Nova-Auction/css/styles.css">
    <link rel="stylesheet" href="/Nova-Auction/css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php 
        printNav();
    ?>

    
    <div class="main">
        
        <div class="left">
            <h1><?php 
            $user_info = Database("select first_name, last_name from user_info where id = '".$_SESSION['user_id']."'",1);
            echo $user_info[0][0]." ".$user_info[0][1];
            ?></h1>
            <a href='/Nova-Auction/pages/register.php'>Logout</a>
        </div>

        <div class="users-items">
            <div class="item">
                <img src="https://images.pexels.com/photos/270404/pexels-photo-270404.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" width=30px height=30px>
                <h2>Toyota cmasop</h2>
                <a href="">Select</a>
            </div>
        </div>

    </div>

    <footer class="footer">
        <p>Copyright &copy; 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
</html>