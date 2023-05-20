<?php
// init PHP
require_once "../lib.php"; 
$res = Database("UPDATE user_info SET img_path = CONCAT('https://api.dicebear.com/6.x/', '{$_GET['t']}' ,'/png?seed=', first_name, FLOOR(RAND() * 5000) + 1, '&backgroundRotation=0,360,-310,-320,-330&backgroundColor=ffdfbf,ffd5dc,d1d4f9,c0aede,b6e3f4')", 0);
print(json_encode($res));