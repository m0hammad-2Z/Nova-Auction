<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="/Nova-Auction/css/styles.css">
    <link rel="stylesheet" href="/Nova-Auction/css/auction.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
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
                    <a href="/Nova-Auction/pages/contact.php">Contact</a>
                    <a href="/Nova-Auction/pages/about.php">About</a>
                </div>
                <div class="nav-icons">
                    <a href="/Nova-Auction/pages/products.php">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="/Nova-Auction/pages/register.php">
                        <i class="fas fa-user-alt"></i>
                    </a>
                </div>
            </div>
        </nav>

    
    <div class="main">
        
            <div class="left-container">
            <div class="item-pic container">
                <div class="main-pic">
                    <img id="blurred" src="https://picsum.photos/1001" alt="">
                    <img src="https://picsum.photos/1001" alt="">
                </div>

                <div class="side-pics">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                    <img src="https://picsum.photos/100" alt="">
                </div>

            </div>
                    <div class="info container">
                        <div class="user-info">
                        <img src="https://picsum.photos/100?b" alt="">
                        <span><a href="#">mohammod mahmod</a></span>
                        </div>
                    </div>
                    
            </div>
            <div class="right-container">

            <div class="bid container">


                <div class="main-bid">
                    <h2>Place a Bid</h2>
                    <h3>Last Bid :7500$</h3>
                    <h3 id="Timer">Time left: Loading...</h3>
                    <input type="number">
                    <button class="button">place a bid</button>
            </div>

            <div class="last-bid">
                <h2>Last bidders</h2>
                <div class="last-bid-info">
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>
                    <p>fdsf</p>

            
                </div>
            </div>
        </div>
        
    
        <div class="live-comments container">
                <h2>Live Comment</h2>
               <div class="live-comment">
                <p>hii</p>
                <p>hidi</p>
                <p>hwaii</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
                <p>hidwi</p>
               </div>
               <div>
                    <input type="text">
                    <button class="button">Send</button>
               </div>
        </div>
    </div>
    </div>
    <script defer>
        var data;
        let expDate;
        let serDate;
        let counter = 1;
        let timer = document.getElementById("Timer");
        let conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
            conn.send('Hello World!');

        };

        conn.onmessage = function(e) {
            data = JSON.parse(e.data);
            serDate = data["ser_date"].split(" ");
            serDate = new Date(serDate[0],serDate[1]-1,serDate[2],serDate[3],serDate[4],serDate[5]);
            expDate = data["exp_date"].split(" ");
            expDate = new Date(expDate[0],expDate[1]-1,expDate[2],expDate[3],expDate[4],expDate[5]);
        };
        
        


        timeUpdate = setInterval(()=>{
            let leftTime = (expDate.getTime() - (serDate.getTime() + (++counter)*1000));
            if(Math.floor(leftTime/1000) <=0){
                clearInterval(timeUpdate);
                timer.innerText = "Ended";
            }
            else{
            timer.innerText ="Time left:"+Math.floor(leftTime/1000)+"s";
            }
        },1000)
        
    </script>
    <footer class="footer">
        <p>Copyright &copy; 2022 Nova Auction | Design By Humble Ghost Team</p>
    </footer>
</body>
</html>