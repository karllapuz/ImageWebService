<?php
    $categories = array("Travel", "Architecture", "People", "Nature", "Food", "Arts", "Sports", "Others");
    $categoryIcon = array("plane", "university", "user", "tree", "utensils", "paint brush", "football ball", "camera");
    $categoryDesc = array("See the beauty of the world from the lens of travellers", "Architecture", "People", "Nature", "Food", "Arts", "Sports", "Others");
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
                Shopping Cart
            </div>
        </div>

        <div class="pusher">
            <!-- NAVBAR -->
            <div id="navbar" class="ui container">
                <div class="ui large secondary menu">
                    <div class="logo header item">
                        <img src="assets/logo/MikaLogo.png" alt="Logo">
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
                            <a class="item">Travel</a>
                            <a class="item">Architecture</a>
                            <a class="item">People</a>
                            <a class="item">Nature</a>
                            <a class="item">Food</a>
                            <a class="item">Arts</a>
                            <a class="item">Sports</a>
                            <a class="item">Others</a>
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
                            <p><strong>Welcome, First Name</strong></p>
                        </div>
                        <div class="ui item">
                            <button class="ui right labeled icon green button">
                            <i class="plus icon"></i>
                                Credits: 3
                            </button>
                        </div>
                        <a class="ui item">
                            <div class="ui negative button">Logout</div>
                        </a>
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

                        <?php for ($i = 1; $i <= 4; $i++) { ?>
                            <div class="ui column raised card">
                                <div class="ui blurring dimmable image">
                                    <div class="ui dimmer">
                                        <div class="content">
                                            <div class="center">
                                            <a><div class="ui inverted green button"><i class="dollar sign icon"></i>Buy</div></a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="https://picsum.photos/250">
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
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <!-- DIVIDER -->
            <div class="ui horizontal divider container">
                TOP PICKS BY CATEGORY
            </div>

            <!-- OTHER CATEGORIES -->
            <div id="category-segment" class="ui two column doubling stackable grid container">
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
                            <div class="ui raised attached segment">
                                <div class="ui two center aligned doubling stackable container cards">

                                    <?php for ($k = 1; $k <= 2; $k++) { ?>
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
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="ui bottom attached segment">
                                <button class="ui fluid teal button">
                                    <i class="grid layout icon"></i>
                                    View all
                                </button>
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