<?php
function Database($query,$type){
    //0 for insert
    //1 for load
    $conn = new mysqli("localhost","root", "", "nova_auction");
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }


    if($type == 0){
        $res = mysqli_query($conn,$query);
    }
    else if($type == 1){
        $res = mysqli_query($conn,$query)->fetch_all(MYSQLI_BOTH);
    }

    mysqli_close($conn);
    return $res;
}

?>