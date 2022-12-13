<?php
// init PHP
require "../lib.php"; 
$q = "select first_name from user_info where id = '".$_SESSION["id"]."'";
echo $q . "<br>";
print_r(Database("select first_name from user_info where id = '".$_SESSION["id"]."'",1));
?>

