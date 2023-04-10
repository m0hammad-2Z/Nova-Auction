<?php
// init PHP
require_once "../lib.php"; 
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
                $res = Database("select * from user_info",1);

                foreach($res as $r){
                  ?>

                    <tr>
                    <td><?php echo $r['first_name'].$r['last_name']; ?></td>
                    <td><?php echo $r['email']; ?></td>
                    <td>Admin</td>
                    <td><button class="btn">Delete</button></td>
                    <td><button class="btn">Ban</button></td>
                  </tr>
                  <tr>

                <?php } ?>
          

          </tbody>
        </table>
      </div>
      

    <footer>
      <p>&copy; 2023 MySiteName. All rights reserved.</p>
    </footer>
  </body>
</html>
