<?php
session_start();

function Database($query, $Insert_or_Load,$arrayType = MYSQLI_BOTH)
{
    //0 for insert
    //1 for load
    $conn = new mysqli("localhost", "root", "", "nova_auction");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if ($Insert_or_Load == 0) {
        $res = mysqli_query($conn, $query);
    } else if ($Insert_or_Load == 1) {
        $res = mysqli_query($conn, $query)->fetch_all($arrayType);
    }

    mysqli_close($conn);
    return $res;
}


function checkUserId(){
    if (isset($_SESSION['user_id'])) {
        if(empty( Database("select first_name from user_info where id = '".$_SESSION['user_id']."'",1))){
            session_destroy();
            $_SESSION = [];
            return false;
        }else
        return true;
    }
    return false;
}

function printNav()
{
    checkUserId();

    if (!isset($_SESSION['user_id'])) {
        print("
        <nav class='main-nav'>
            <div class='navbar'>
                <div class='logo'>
                    <a href='/Nova-Auction/'>
                        <h1>N<span style='color: var(--color);'>O</span>VA</h1>
                    </a>
                </div>
                <div class='nav-links'>
                    <a href='/Nova-Auction/'>Home</a>
                    <a href='/Nova-Auction/pages/products.php'>Products</a>
                    <a href='/Nova-Auction/pages/about.php'>About</a>
                </div>
                <div class='nav-icons'>
                    <a id='user-icon' href='/Nova-Auction/pages/products.php'>
                        <i class='fas fa-search'></i>
                    </a>
                    <a id='search-icon' href='/Nova-Auction/pages/register.php'>
                        <i class='fas fa-user-alt'></i>
                    </a>
                </div>
            </div>
        </nav>");
    } else {
        
        print("
        <nav class='main-nav'>
            <div class='navbar'>
                <div class='logo'>
                    <a href='/Nova-Auction/'>
                        <h1>N<span style='color: var(--color);'>O</span>VA</h1>
                    </a>
                </div>
                <div class='nav-links'>
                    <a href='/Nova-Auction/'>Home</a>
                    <a href='/Nova-Auction/pages/products.php'>Products</a>
                    <a href='/Nova-Auction/pages/about.php'>About</a>
                </div>
                <div class='nav-icons'>
                    <a id='user-icon' href='/Nova-Auction/pages/products.php'>
                        <i class='fas fa-search'></i>
                    </a>
                    <a name='sell' id='sell' class='button' href='/Nova-Auction/pages/sell.php'>Sell</a>
                    <a href='/Nova-Auction/pages/register.php'>".
                        Database("select first_name from user_info where id = '".$_SESSION['user_id']."'",1)[0][0]
                    ."
                        </a>
                </div>
            </div>
        </nav>");
    }
}
