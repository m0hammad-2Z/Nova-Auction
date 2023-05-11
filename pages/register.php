<?php
// init PHP
require_once "../lib.php"; ?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Account</title>
    <link rel='stylesheet' href='/Nova-Auction/css/styles.css'>
    <link rel="icon" type="image/png" href="/Nova-Auction/img/fav.png">
    <link rel='stylesheet' href='/Nova-Auction/css/register.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
  </head>
  <body> <?php printNav(); ?> <div class='main'>
      <div class='left'>
        <h1>Log in</h1>
        <form method='post'>
          <label for='Email'>Email</label>
          <input type='email' name='email' placeholder='example@example.exa' required>
          <label for='password'>Password</label>
          <input type='password' name='pass' required>
          <button class='button' name='login_button' type='submit'>Log in</button>
        </form>
        <a href=''>Lost your password?</a>
            <?php
            extract($_POST);

            if (!isset($_SESSION['user_id'])) {
                if (isset($_POST["login_button"])) {
                    if (
                        count(
                            Database(
                                "select email from user_info where email = '$email' and pass='$pass'",
                                1
                            )
                        ) != 0
                    ) {
                        $_SESSION['user_id'] = Database(
                            "select id from user_info where email='$email' and pass='$pass'",
                            1
                        )[0][0];
                        header("Location: /Nova-Auction/");
                    } else {
                        echo '<span class="register_error">Error in email or password</span>';
                    }
                }
            } 
            else {
                session_destroy();
                header("Location: /Nova-Auction/");
            }
            ?>

        </div>

        <div class='right'>
            <h1>Register</h1>
            <form method='post' enctype="multipart/form-data">
                <label for='Email'>Full Name</label><input type='text' name='fn' placeholder='First Name' required>
                <input type='text' name='ln' placeholder='Last Name' required>
                <label for='Email'>Email</label><input name='email' type='email' placeholder='example@example.exa' required>
                <label for='password'>Password</label><input name='pass' type='password' required>
                <label for='tel'>Phone number</label><input name='tele' type='tel' placeholder='0712345678' required>
                <label for='image'>Upload an image</label><input id='image' type='file' name='image'  required>
                <button class='button' name='register_button' type='submit'>Sign up</button>
            </form>
            <?php
            extract($_POST);

            if (isset($_POST["register_button"])) {
                if (
                    count(
                        Database(
                            "select email from user_info where email = '$email'",
                            1
                        )
                    ) == 0 &&
                    count(
                        Database(
                            "select phonenumber from user_info where phonenumber = '$tele'",
                            1
                        )
                    ) == 0
                ) {

                    Database(
                        "INSERT INTO user_info VALUES(default,'$fn','$ln','$email','$pass','$tele','User', default, Null)",
                        0
                    );
                    
                    $_SESSION['user_id'] = Database(
                        "select id from user_info where email='$email' and pass='$pass'",
                        1
                    )[0][0];

                    $des = "../" . "users_account_images/" . $_SESSION['user_id'] . '.' . basename($_FILES["image"]["type"]);
                        echo $des;
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $des)) {
                        Database("UPDATE user_info SET img_path = '{$des}' WHERE id = '{$_SESSION['user_id']}'" , 0);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }

                    header("Location: /Nova-Auction/");
                } else {
                    echo "<span class='register_error'>YOU ARE NOT WELCOME!</span>";
                }
            }
            ?>

        </div>
    </div>


    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>

</html>