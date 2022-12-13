<?php
// init PHP
require "../lib.php"; 
$q = "select first_name from user_info where user_id = '".$_SESSION["user_id"]."'";
echo $q . "<br>";
print_r(Database("select first_name from user_info where user_id = '".$_SESSION["user_id"]."'",1));
?>

