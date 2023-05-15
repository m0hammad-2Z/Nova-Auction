<?php
session_start();

function Database($query, $Insert_or_Load, $arrayType = MYSQLI_BOTH)
{
    //0 for insert
    //1 for load
    $conn = new mysqli("localhost", "root", "", "nova_auction");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    mysqli_query($conn,"set names 'utf8'");
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
        }else{
        return true;}
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
                        <h1>NO<span style='color: var(--color);'>V</span>A</h1>
                    </a>
                </div>
                <div class='nav-links'>
                  
                    
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
            $isHome = FALSE;
            if (basename($_SERVER['PHP_SELF']) == 'index.php')
                $isHome = TRUE;
                
            $user_img = Database("select img_path from user_info where id = '".$_SESSION['user_id']."'",1)[0][0];
                 
            $isLink = substr($user_img, 0, 5) === 'http:' || substr($user_img, 0, 5) === 'https' ? True : False;

            if($isLink){
                $user_img = $user_img;
            }else if ($user_img == NULL){
                $user_img = 'https://api.dicebear.com/6.x/initials/png?seed=' . rand(1, 5000);
            }else{
                if($isHome)
                    $user_img = $user_img;
                else
                    $user_img = '../' . $user_img;
            }
        
        print("
        <nav class='main-nav'>
            <div class='navbar'>
                <div class='logo'>
                    <a href='/Nova-Auction/'>
                        <h1>NO<span style='color: var(--color);'>V</span>A</h1>
                    </a>
                </div>
                <div class='nav-links'>
                
                </div>
                <div class='nav-icons'>
                    <a id='user-icon' href='/Nova-Auction/pages/products.php'>
                        <i class='fas fa-search'></i>
                    </a>
                    <a id='sell' href='/Nova-Auction/pages/sell.php'>
                        <svg  class='nav-svg' width='800px' height='800px' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' stroke-width='0'>
                        <g>
                        <rect   fill='none' height='20' id='_--Rectangle' rx='2' ry='2' stroke-linecap='round' stroke-linejoin='round' stroke-width='4' width='20' height='20' x='2' y='2'/>
                        <line   fill='#000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' x1='15.5' x2='8.5' y1='12' y2='12'/>
                        <line   fill='#000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' x1='12' x2='12' y1='15.5' y2='8.5'/>
                        </g>
                        </svg>
                    </a>
                    <a href='/Nova-Auction/pages/user.php'><img class='user-image' id='user-image' src=".
                    $user_img
                    .">
                        </a>
                </div>
            </div>
        </nav>");
    }
}
?>
