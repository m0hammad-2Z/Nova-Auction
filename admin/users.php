<?php
// init PHP
require_once "../lib.php"; 



if (!isset($_SESSION['user_id'])) {
    header("Location: /Nova-Auction/");
}else{
  $r = Database("select * from user_info where id = {$_SESSION['user_id']}",1);
  if($r[0]['rule'] != 'Admin'){
    header("Location: /Nova-Auction/");
  }
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Page</title>
    <link rel="stylesheet" href="././users.css" />
    <link rel="stylesheet" href="././index.css" />
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="././index.php">Dashboard</a></li>
          <li><a href="././users.php">Users</a></li>
          <li><a href="././cars.php">Cars</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="container">
        <h1>Users</h1>
        <table>
        <thead>
        <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Delete</th>
              <th>Ban</th>
            </tr>
        </thead>
        <tbody>
          <?php 

                if(isset($_POST['delete-option'])){
                  $cars = Database("SELECT car_id, img_path  FROM items WHERE user_id = {$_POST['delete-option']}", 1);
                  Database("DELETE FROM items WHERE user_id = {$_POST['delete-option']}", 0);
                  foreach($cars as $car) { 
                    Database("DELETE FROM cars WHERE id = {$car[0]}", 0);

                    #Delete images
                    $image ="../". $car[1];
                    if (file_exists($image)) {
                      print("exist");
                        unlink($image);
                    }else echo ("not exist");
                  }
                  Database("DELETE FROM user_info WHERE id = {$_POST['delete-option']}", 0);
                }

                


                $res = Database("select * from user_info ORDER BY rule asc",1);

                foreach($res as $r){
                  ?>
                  
                    <tr>
                    <td><?php echo $r['first_name']." ".$r['last_name']; ?></td>
                    <td><?php echo $r['email']; ?></td>
                    <td><?php echo $r['rule']; ?></td>
                    <td><form method="post">
                          <button value=<?php echo $r['id']?> class="btn" name="delete-option">Delete</button>
                        </form>
                    </td>
                    <?php $r['banned'] == false ? print("<td><button class='btn' name='ban-option'>Ban</button></td>") : print("<td><button class='btn' name='un-ban-option'>Ban</button></td>");

                     ?>
                  </tr>
                  <tr>

                <?php } 

                
                ?>

                
          

          </tbody>
        </table>
      </div>
      

    <footer>
      <p>&copy; 2023 MySiteName. All rights reserved.</p>
    </footer>
  </body>
</html>
