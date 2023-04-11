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
    <link rel="stylesheet" href="././index.css" />
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="././index.php">Dashboard</a></li>
          <li><a href="././users.php">Users</a></li>
          <li><a href="././cars.php">Cars</a></li>
          <li><a href='/Nova-Auction/pages/register.php'>Logout</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <h1>Welcome to the Admin Page</h1>
      <p>Here you can manage all aspects of the site.</p>
    </main>
    <footer>
      <p>&copy; 2023 MySiteName. All rights reserved.</p>
    </footer>
  </body>
</html>
