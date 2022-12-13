<?php
// init PHP
require "../lib.php"; 
$q = "select user_firstname from user_info where user_id = '".$_SESSION["user_id"]."'";
echo $q . "<br>";
print_r(Database("select user_firstname from user_info where user_id = '".$_SESSION["user_id"]."'",1));
?>

