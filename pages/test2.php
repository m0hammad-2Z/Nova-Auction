<?php 
$Not_POST = json_decode(file_get_contents("php://input"),true);

$hii = array($Not_POST['a'],"gdrhd","Gdrhr");

echo json_encode($hii);
?>