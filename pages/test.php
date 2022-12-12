<?php 
require "../lib.php";
$res = retData("select email from user_info");


echo var_dump($res);
?>