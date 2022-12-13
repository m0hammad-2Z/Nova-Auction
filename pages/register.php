<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="/Nova-Auction/css/styles.css">
    <link rel="stylesheet" href="/Nova-Auction/css/register.css">
    <script src="/Nova-Auction/js/cookies.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php 
        require "../lib.php";
        if(!isset($_SESSION['user_id'])){
            printNav(0);
        }else{
            printNav(1);
        }
    ?>


    <div class="main">
        <div class="left">
            <h1>Log in</h1>
            <form method="post">
                <label for="Email">Email</label><input type="email" name="email" placeholder="example@example.exa" required>
                <label for="password">Password</label><input type="password" name="pass" required>
                <!-- <div><input type="checkbox" name="remember_me"> <label for="Email">Remember me</label></div> -->
                
                <button class="button" name="login_button" type="submit">Log in</button> 
            </form>
            <a href="" >Lost your password?</a>

            <?php
            session_start();
            extract($_POST);

            if(!isset($_SESSION['user_id'])){
                if(isset($_POST['login_button'])) {
                    if(count(Database("select email from user_info where email = '$email' and pass='$pass'",1)) != 0)
                    {
                        $_SESSION['user_id'] = Database("select user_id from user_info where email='$email' and pass='$pass'", 1)[0][0];
                        header('Location: /Nova-Auction/');
                    }else{
                        echo '<span class="register_error">Error in email or password</span>';
                    }
                }
            }else{
                    Database("select email from user_info where user_id = '".$_SESSION['user_id']."'",1);
                    header('Location: /Nova-Auction/');
            }
            ?>

        </div>

        <div class="right">
            <h1>Register</h1>
            <form  method="post">
                <label for="Email">Full Name</label><input type="text" name="fn" placeholder="First Name" required>
                <input type="text" name="ln" placeholder="Last Name" required>
                <label for="Email">Email</label><input name="email" type="email" placeholder="example@example.exa" required>
                <label for="password">Password</label><input name="pass" type="password"  required>
                <label for="tel">Phone number</label><input name="tele" type="tel" placeholder="0712345678" required>
                <button class="button" name="register_button" type="submit">Sign up</button>
            </form>
            <?php
                if(isset($_POST['register_button'])) {
                    
                    extract($_POST);
                    if(count(Database("select email from user_info where email = '$email'",1)) == 0
                    ||
                    count(Database("select phonenumber from user_info where phonenumber = '$tele'",1))==0)
                    {
                        Database("INSERT INTO user_info VALUES(default,'$fn','$ln','$email','$pass','$tele')",0);
                    }else{
                        echo '<span class="register_error">you are not welcome</span>';
                    }
            }
            ?>
            
        </div>
    </div>


    <footer class="footer">
        <p>Copyright &copy; 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
</html>