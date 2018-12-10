<?php
    $categories = array("Travel", "Architecture", "People", "Nature", "Food", "Arts", "Sports", "Others");
    $categoryIcon = array("plane", "university", "user", "tree", "utensils", "paint brush", "football ball", "camera");
    $categoryDesc = array("See the beauty of the world from the lens of adventurers and trailblazers", 
                          "From skyscrapers to quirky structures, these shots are always a sight for sore eyes", 
                          "True candid moments and experiences of every day people showing the essence of humanity", 
                          "Immerse in the serenity and scenic looks of nature captured by only the best", 
                          "Feast and find delicious delicacies around the world from street foods to high end dining", 
                          "Discover classic and modern works of art in different medium and background", 
                          "Greatness of human power and skill are captured in different genres of sports", 
                          "Other photographic contents that are just too specific and unique to be categorized");
    
    include('server.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

     // Fetch user information
     $username = $_SESSION['username'];
     $userQuery = "SELECT * FROM customer WHERE username='$username';";
     $userResults = mysqli_query($db, $userQuery);
     if(mysqli_num_rows($userResults) == 1) {
         $user = mysqli_fetch_assoc($userResults);
         $userID = $user['customerID'];
         $firstName = $user['firstName'];
         $lastName = $user['lastName'];
         $userType = $user['userType'];
         $credits = $user['credits'];
     }

    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "logout":
                session_destroy();
                unset($_SESSION["username"]);
                header("location: index.php");
        }
    }

    // echo $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section id="gallery">
        
        <!-- SHOPPING CART -->
        <div class="ui vertical inverted wide sidebar menu">
            <div class="item">
                <div class="header">
                    <h2>Shopping Cart</h2>
                </div>
                <div class="ui middle aligned divided list">
                    <div class='item'>
                        <div class='ui grid'>

                            <div class='row'>
                                <div class='ten wide column middle aligned content'>
                                    Name of Photo <br>
                                    <em>by John Doe</em>
                                </div>
                                <div class='three wide column middle aligned content'>
                                    <strong>1</strong>
                                    <i class="copyright icon"></i>
                                </div>
                                <div class='three wide column middle aligned content'>
                                    <a href="" class="ui negative icon button">
                                        <i class="trash alternate icon"></i>
                                    </a>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='ten wide column middle aligned content'>
                                    Name of Photo <br>
                                    <em>by Michelle Luong</em>
                                </div>
                                <div class='three wide column middle aligned content'>
                                    <strong>3</strong>
                                    <i class="copyright icon"></i>
                                </div>
                                <div class='three wide column middle aligned content'>
                                    <a href="" class="ui negative icon button">
                                        <i class="trash alternate icon"></i>
                                    </a>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='ten wide column middle aligned content'>
                                    Name of Photo <br>
                                    <em>by Karl Lapuz</em>
                                </div>
                                <div class='three wide column middle aligned content'>
                                    <strong>2</strong>
                                    <i class="copyright icon"></i>
                                </div>
                                <div class='three wide column middle aligned content'>
                                    <a href="" class="ui negative icon button">
                                        <i class="trash alternate icon"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div> 
                </div> 
            </div>

            <!-- TOTAL -->
            <div class="item">
                <div class="ui grid">
                    <div class="row">
                        <div class="ten wide column">
                            <span><h3>Total:</h3></span>
                        </div>
                        <div class="six wide column right floated right aligned">
                            <span><h3>
                                <strong>6</strong>
                                <i class="copyright icon"></i>
                            </h3></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PURCHASE BUTTON -->
            <div class="item">

                <!-- RENDER IF TOTAL IS GREATER THAN CREDITS -->
                <div class='ui negative limit message'>
                    <div class='header'>
                        Insufficient Credits!
                    </div>
                    <p>You do not have enough credits to make this purchase. Please remove some items in your shopping cart or add credits to your account.</p>
                </div>
                <button class='ui disabled fluid green button'><i class="dollar sign icon"></i> Confirm Purchase</button>

                <!-- VALID PURCHASE BUTTON -->
                <button class='ui fluid green button'><i class="dollar sign icon"></i> Confirm Purchase</button>

            </div>
        </div>

        <div class="pusher">
            <!-- NAVBAR -->
            <div id="navbar" class="ui container">
                <div class="ui large secondary menu">
                    <div class="logo header item">
                        <img src="assets/images/MikaLogo.png" alt="Logo">
                    </div>
                    <a class="item" href="profile.php">
                        <i class="home icon"></i>
                        Home
                    </a>
                    <div class="ui dropdown item">
                        <i class="images icon"></i>
                        Categories
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <a href="travel.php"class="item">Travel</a>
                            <a href="architecture.php"class="item">Architecture</a>
                            <a href="people.php"class="item">People</a>
                            <a href="nature.php"class="item">Nature</a>
                            <a href="food.php"class="item">Food</a>
                            <a href="arts.php"class="item">Arts</a>
                            <a href="sports.php"class="item">Sports</a>
                            <a href="others.php"class="item">Others</a>
                        </div>
                    </div>
                    <div class="right menu">
                        <!-- <div class="item">
                            <div class="ui icon input">
                                <input type="text" placeholder="Search...">
                                <i class="search link icon"></i>
                            </div>
                        </div> -->
                        <div class="ui item">
                            <p><strong>Welcome, <?php echo $_SESSION['username']; ?>!</strong></p>
                        </div>
                        <div class="ui item">
                            <button class="ui right labeled icon green button">
                            <i class="plus icon"></i>
                                Credits: <?php echo $credits ?>
                            </button>
                        </div>
                        <div class="ui item">
                            <a class="ui negative button" href="gallery.php?action=logout">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- STICKY BUTTON  -->
            <div id="toggle" class="ui sticky teal large launch right attached fixed button">
                <i class="cart plus icon"></i>
                <span class="text">Cart</span>
            </div>

            <!-- GALLERY HEADER TEXT -->
            <div class="ui center aligned header">
                <h1>Gallery</h1>
            </div>

            <!-- TOP PICKS SEGMENT -->
            <div id="top-segment" class="ui center aligned container">
                <h2 class="ui teal top attached left aligned header">
                    <i class="chess queen icon"></i>
                    <div class="content">
                        Top Picks For You
                        <div class="sub header">
                            Content curated specifically for you based on the photos you've liked or purchased
                        </div>
                    </div>    
                </h2>
                <div class="ui raised attached segment">
                    <div class="ui four center aligned doubling stackable container cards">

                        <?php for ($i = 1; $i <= 8; $i++) { ?>
                            <div class="ui column raised card">
                                <div class="ui blurring dimmable image">
                                    <div class="ui dimmer">
                                        <div class="content">
                                            <div class="center">
                                            <a><div class="ui inverted green button"><i class="cart icon"></i>Add to cart</div></a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="<?php echo addWatermark("https://picsum.photos/1500", "result.png"); ?>">
                                </div>
                                <div class="content">
                                    <h3 class="left aligned header">Wild Sunset</h3>
                                    <div class="right floated meta">
                                        
                                        <p class="ui green tag label">1 credit</p>
                                    </div>
                                    <div class="left aligned">
                                        
                                        <span><em>by John Doe</em></span>
                                    </div>
                                    <div class="left aligned description">Nature, Travel 
                                    </div>
                                </div>
                                <div class="extra content">
                                    <span class="left floated">
                                        <i class="users icon"></i>
                                        12 Purchases
                                    </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <!-- DIVIDER -->
            <div class="ui horizontal divider container">
                VIEW ALL PHOTOS BY CATEGORY
            </div>

            <!-- OTHER CATEGORIES -->
            <div id="category-segment" class="ui four column doubling stackable grid container">
                <?php for ($j = 0; $j <= 7; $j++) { ?>
                    <div class="column">
                        <div class="ui center aligned container">
                            <h2 class="ui teal top attached left aligned header">
                                <i class="<?php echo $categoryIcon[$j]; ?> icon"></i>
                                <div class="content">
                                    <?php echo $categories[$j]; ?>
                                    <div class="sub header">
                                        <?php echo $categoryDesc[$j]; ?>
                                    </div>
                                </div>    
                            </h2>
                            <!-- <div class="ui raised attached segment">
                                <div class="ui two center aligned doubling stackable container cards">

                                    <?php // for ($k = 1; $k <= 2; $k++) { ?>
                                        <div class="ui column raised card">
                                            <div class="ui blurring dimmable image">
                                                <div class="ui dimmer">
                                                    <div class="content">
                                                        <div class="center">
                                                        <a><div class="ui inverted green button"><i class="dollar sign icon"></i>Buy</div></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="https://picsum.photos/150">
                                            </div>
                                            <div class="content">
                                                <h3 class="left aligned header">Wild Sunset</h3>
                                                <div class="right floated meta">
                                                    
                                                    <p class="ui green tag label">1 credit</p>
                                                </div>
                                                <div class="left aligned">
                                                    
                                                    <span><em>by John Doe</em></span>
                                                </div>
                                                <div class="left aligned description">Nature, Travel 
                                                </div>
                                            </div>
                                            <div class="extra content">
                                                <span class="left floated like">
                                                    <i class="like icon"></i>
                                                    Like
                                                </span>
                                                <span class="right floated">
                                                    51 Likes
                                                </span>
                                            </div>
                                        </div>
                                    <?php // } ?>
                                </div>
                            </div> -->
                            <div class="ui bottom attached segment">
                                <a href="<?php echo strtolower($categories[$j]); ?>.php" class="ui fluid teal button">
                                    <i class="grid layout icon"></i>
                                    View all
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        
        </div>
        
    </section>

    <script>
        $('#toggle').click(function(){
            $('.ui.sidebar').sidebar('toggle');
        });
        $(".launch.button").mouseenter(function(){
            $(this).stop().animate({width: '100px'}, 200, 
                function(){$(this).find('.text').show();});
            }).mouseleave(function (event){
            $(this).find('.text').hide();
            $(this).stop().animate({width: '70px'}, 200);
        });
        $('.ui.dropdown').dropdown();
        $('.image').dimmer({
            on: 'hover'
        });
    </script>
</body>
</html>