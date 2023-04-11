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
    <link rel="stylesheet" href="././edit.css" />
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
        <h1>Edit Car</h1>
        <form  method="post">
          <div class="form-group">
            <label for="make">Make:</label>
            <input type="text" id="make" name="make" value="Toyota">
          </div>
          <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="Camry">
          </div>
          <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" value="2018">
          </div>
          <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="Black">
          </div>
          <div class="form-group">
            <label for="owner">Owner:</label>
            <input type="text" id="owner" name="owner" value="John Doe">
          </div>
          <div class="button-group">
            <button type="submit" class="btn save-btn">Save</button>
            <button type="button" class="btn cancel-btn">Cancel</button>
          </div>
        </form>
      </div>
      
    
    <footer>
      <p>&copy; 2023 MySiteName. All rights reserved.</p>
    </footer>
  </body>
</html>
