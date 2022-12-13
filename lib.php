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




function printNav($logedIn){
    if($logedIn == 0){
        print('
        <nav class="main-nav">
            <div class="navbar">
                <div class="logo">
                    <a href="/Nova-Auction/">
                        <h1>N<span style="color: var(--color);">O</span>VA</h1>
                    </a>
                </div>
                <div class="nav-links">
                    <a href="/Nova-Auction/">Home</a>
                    <a href="/Nova-Auction/pages/products.php">Products</a>
                    <a href="/Nova-Auction/pages/about.php">About</a>
                </div>
                <div class="nav-icons">
                    <a id="user-icon" href="/Nova-Auction/pages/products.php">
                        <i class="fas fa-search"></i>
                    </a>
                    <a id="search-icon" href="/Nova-Auction/pages/register.php">
                        <i class="fas fa-user-alt"></i>
                    </a>
                </div>
            </div>
        </nav>');
    }
    else{
        print('
        <nav class="main-nav">
            <div class="navbar">
                <div class="logo">
                    <a href="/Nova-Auction/">
                        <h1>N<span style="color: var(--color);">O</span>VA</h1>
                    </a>
                </div>
                <div class="nav-links">
                    <a href="/Nova-Auction/">Home</a>
                    <a href="/Nova-Auction/pages/products.php">Products</a>
                    <a href="/Nova-Auction/pages/about.php">About</a>
                </div>
                <div class="nav-icons">
                    <a id="user-icon" href="/Nova-Auction/pages/products.php">
                        <i class="fas fa-search"></i>
                    </a>
                    <a id="search-icon" href="/Nova-Auction/pages/register.php">
                        <i class="fas fa-user-alt"></i>
                    </a>
                    <button name="sell-button" id="sell-button" class="button" style="display: block">Sell</button>
                </div>
            </div>
        </nav>');
    }
}
?>