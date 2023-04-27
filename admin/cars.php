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
    <link rel="stylesheet" href="./users.css" />
    <link rel="stylesheet" href="./index.css" />
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="./index.php">Dashboard</a></li>
          <li><a href="./users.php">Users</a></li>
          <li><a href="./cars.php">Cars</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="container">
        <h1>Cars</h1>
        <div class="button-group">
          <button class="btn add-btn">Add Car</button>
          <button class="btn delete-btn">Delete Selected</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>Select</th>
              <th>Make</th>
              <th>Model</th>
              <th>Year</th>
              <th>Color</th>
              <th>Owner</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $res = Database("SELECT * from items, cars",1);
            
            ?>
            <tr>
              <td><input type="checkbox"></td>
              <td>Toyota</td>
              <td>Camry</td>
              <td>2018</td>
              <td>Black</td>
              <td>John Doe</td>
              <td><button class="btn edit-btn" >Edit</button></td>
            </tr>
           
          </tbody>
        </table>
      </div>
      
    <footer>
      <p>&copy; 2023 MySiteName. All rights reserved.</p>
    </footer>
  </body>
</html>
