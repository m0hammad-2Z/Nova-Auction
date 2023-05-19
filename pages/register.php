<?php
// init PHP
require_once "../lib.php";
if (isset($_SESSION['user_id'])) {
    $_SESSION = [];
    session_destroy();
}

?>
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
        <!-- <a href=''>Lost your password?</a> -->
            <?php
            extract($_POST);

                
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
           
            ?>

        </div>

        <div class='right'>
            <h1>Register</h1>
            <form method='post' enctype="multipart/form-data">
                
            <label for='name'>Full Name</label>
                <input type='text'  name='fn' placeholder='First Name' required>
                <input type='text' name='ln' placeholder='Last Name' required>

                
                <label for='Email'>Email</label>
                <input name='email' oninvalid="this.setCustomValidity('Please follow this pattern (example@example.exa)')" oninput="setCustomValidity('');" pattern="^\w+[-\.\+\w]*@\w+\.\w+$" type='email' placeholder='example@example.exa' required>
                
                <label for='password'>Password</label>
                <input name='pass' type='password' required pattern="^(?=.*[a-z])(?=.*[A-Z]).{8,16}" title="Your password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter.">
                
                <label for='tel'>Phone number</label>
                <input name='tele' oninvalid="this.setCustomValidity('Please follow this pattern (0791234567)')" oninput="setCustomValidity('');" pattern="^07[7-9]{1}[0-9]{7}$" type='tel' placeholder='0791234567' required>
                <input onchange='readURL(this)' id='image' type='file' name='image'><label for='image'>Upload an image</label><img for='image' id='preview'>

                <button class='button' name='register_button' type='submit'>Sign up</button>
            </form>
            <?php
            extract($_POST);

            $emailPattern = "/^\w+[-\.\+\w]*@\w+\.\w+$/i";
            $phonePattern = "/^07[7-9]{1}[0-9]{7}$/i";
            // echo $email." ".preg_match($emailPattern,$email) ."<br>" . $tele . " ".preg_match($phonePattern,$tele);
        
            if (isset($_POST["register_button"]) && preg_match($emailPattern,$email) &&  preg_match($phonePattern,$tele)) {

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
                    $email  = trim($email);
                    $tele = trim($tele);

                    Database(
                        "INSERT INTO user_info VALUES(default,'$fn','$ln','$email','$pass','$tele','User', default, Null)",
                        0
                    );
                    
                    $_SESSION['user_id'] = Database(
                        "select id from user_info where email='$email' and pass='$pass'",
                        1
                    )[0][0];
                    $finalDes = "";
                    $rn = rand(1, 50000);
                    $finalDes = 'https://api.dicebear.com/6.x/adventurer/png?seed=' . $fn . $rn . "&backgroundRotation=0,360,-310,-320,-330&backgroundColor=ffdfbf,ffd5dc,d1d4f9,c0aede,b6e3f4";

                    $des =  "users_account_images/" . $_SESSION['user_id'] . '.' . basename($_FILES["image"]["type"]);
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], '../' . $des)) {
                            $finalDes = "users_account_images/" . $_SESSION['user_id'] . '.' . basename($_FILES["image"]["type"]);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }                    
                    Database("UPDATE user_info SET img_path = '{$finalDes}' WHERE id = '{$_SESSION['user_id']}'" , 0);

                    
                    header("Location: /Nova-Auction/");
                } else {
                    echo "<span class='register_error'>YOU ARE NOT WELCOME!</span>";
                }
            }
            ?>

        </div>
    </div>


    <footer class='footer'>
        <p>Copyright © 2022 Nova Auction | Design By <a href='/Nova-Auction/pages/about.php'>Humble Ghost Team</a></p>
    </footer>
</body>

<script>
   function readURL(input) {
        
                let preview = document.getElementById("preview");

                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);

                reader.onload = function (e) {
                    const source = e.target.result;
                    let previewImage = document.createElement("img");
                    previewImage.classList.add("img-preview");
                    preview.src = e.target.result;
                    preview.setAttribute("width", "120px");
                    preview.setAttribute("height", "120px");

                    

            }
        }
</script>
</html>