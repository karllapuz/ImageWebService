<?php    

    /*
        Authors: Karl Lapuz and Michelle Luong
    */
    
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
         $userCredits = $user['credits'];
     }

    if(!empty($_GET["imageID"]))
    {
        //creating array of products for cart with image_id as the key
        $products = query("SELECT * FROM imageInfo WHERE imageID='" . $_GET["imageID"] . "'");
        $itemArray =
            array
            (
                $products[0]["imageID"]=>
                array
                (
                    'imageID'=>$products[0]["imageID"],
                    'image'=>$products[0]["imagePath"],
                    'imageName'=>$products[0]["imageName"],
                    'category'=>$products[0]["category"],
                    'photographer'=>$products[0]["photographer"],
                    'credits'=>$products[0]["credits"],
                    'purchases'=>$products[0]["purchases"],
                    'uploader'=>$products[0]["uploader"]
                ) 
            );
    }
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "logout":
                session_destroy();
                unset($_SESSION["username"]);
                header("location: index.php");
                break;

            case "add":
                if(!empty($_SESSION["cart"]))
                {
                    $_SESSION["cart"] = $_SESSION["cart"] + $itemArray;
                }
                else
                {
                    $_SESSION["cart"] = $itemArray;
                }
                break;

            case "remove":
                if(!empty($_SESSION["cart"]))
                {
                    foreach($_SESSION["cart"] as $a => $b)
                    {
                        if($_GET["imageID"] == $b["imageID"])
                        {
                            unset($_SESSION["cart"][$a]);
                        }
                        if(empty($_SESSION["cart"]))
                        {
                            unset($_SESSION["cart"]);
                        }
                    }
                }
                break;
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
    <title>People</title>
    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section class="category">
        
        <!-- SHOPPING CART -->
        <div class="ui vertical inverted wide sidebar menu">
            <div class="item">
                <div class="header">
                    <h2>Shopping Cart</h2>
                </div>
                <div class="ui middle aligned divided list">
                    <div class='item'>
                        <div class='ui grid'>
                            <?php
                                if(isset($_SESSION["cart"]))
                                {
                                    foreach($_SESSION["cart"] as $product)
                                    {
                                        $imageID = $product["imageID"];
                                        $imageName = $product["imageName"];
                                        $credits = $product["credits"];
                                        $photographer = $product["photographer"];
                                        $uploader = $product["uploader"];
                                        echo
                                        "<div class='row'>
                                        <div class='ten wide column middle aligned content'>
                                            $imageName <br>
                                            <em>by $photographer</em>
                                        </div>
                                        <div class='three wide column middle aligned content'>
                                            <strong>$credits</strong>
                                            <i class='copyright icon'></i>
                                        </div>
                                        <div class='three wide column middle aligned content'>
                                            <a href='people.php?action=remove&imageID=$imageID' class='ui negative icon button'>
                                                <i class='trash alternate icon'></i>
                                            </a>
                                        </div>
                                    </div>";
                                    } 
                                }
                            ?>

                        </div>
                    </div> 
                </div> 
            </div>

            <!-- TOTAL -->
            <?php
                    $totalCredits = 0;
                    if(isset($_SESSION["cart"]))
                    {
                        foreach($_SESSION["cart"] as $product)
                        {
                            $totalCredits += $product["credits"];
                        }
                    }
                ?>
            <div class="item">
                <div class="ui grid">
                    <div class="row">
                        <div class="ten wide column">
                            <span><h3>Total:</h3></span>
                        </div>
                        <div class="six wide column right floated right aligned">
                            <span><h3>
                                <strong><?php echo $totalCredits; ?></strong>
                                <i class="copyright icon"></i>
                            </h3></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PURCHASE BUTTON -->
            <div class="item">
                
                <!-- RENDER IF TOTAL IS GREATER THAN CREDITS -->
                <?php
                    if($totalCredits > $userCredits)
                    {
                        echo
                        "<div class='ui negative limit message'>
                            <div class='header'>
                                Insufficient Credits!
                            </div>
                            <p>You do not have enough credits to make this purchase. Please remove some items in your shopping cart or add credits to your account.</p>
                        </div>
                        <button class='ui disabled fluid green button'><i class='dollar sign icon'></i> Confirm Purchase</button>";
                    }
                    else if($totalCredits == 0)
                    {
                        echo
                        "<button class='ui disabled fluid green button'><i class='dollar sign icon'></i> Confirm Purchase</button>";
                    }
                    

                //VALID PURCHASE BUTTON
                else
                {
                    echo 
                    "<form action='profile.php' method='post'>
                        <button type='submit' name='purchase_items' class='ui fluid green button'>
                            <i class='dollar sign icon'></i> Confirm Purchase
                        </button>
                    </form>";
                }
                ?>

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
                            <a href="gallery.php"class="item">All Categories</a>
                            <a href="travel.php"class="item">Travel</a>
                            <a href="architecture.php"class="item">Architecture</a>
                            <a href="people.php"class="active item">People</a>
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
                        <form method="post" action="people.php" class="ui item">
                            <button type="submit" name="add_credits"class="ui right labeled icon green button">
                            <i class="plus icon"></i>
                                Credits: <?php echo $userCredits ?>
                            </button>
                        </form>
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
                <h1>People</h1>
            </div>

            <!-- TOP PICKS SEGMENT -->
            <div id="top-segment" class="ui center aligned container">
                <h2 class="ui teal top attached left aligned header">
                    <i class="chess queen icon"></i>
                    <div class="content">
                        Top Picks For People
                        <div class="sub header">
                            Content curated specifically for you based on the photos you've liked or purchased
                        </div>
                    </div>    
                </h2>
                <div class="ui raised attached segment">
                    <div class="ui four center aligned doubling stackable container cards">

                        <?php 
                            $imagesQuery = "SELECT * FROM imageInfo WHERE category = 'people' ORDER BY purchases DESC;";
                            $images = $db->query($imagesQuery);

                            if(!empty($images)) {

                                for ($x = 0; $x < 4; $x++) {
                                    $images->data_seek($x);
                                    $row = $images->fetch_array(MYSQLI_ASSOC);

                                    $imageID = $row['imageID'];
                                    $imageName = $row['imageName'];
                                    $category = $row['category'];
                                    $imagePath = $row['imagePath'];
                                    $photographer = $row['photographer'];
                                    $credits = $row['credits'];
                                    $purchases = $row['purchases'];
                                    
                                    // Add watermark to the image
                                    // $watermarked = addWatermark($imagePath, "MARKED_".$imagePath);
                                    
                                    // Plurals
                                    $creditString = "credit";
                                    $purchaseString = "Purchase";
                                    if ($credits > 1) $creditString = "credits";
                                    if ($purchases > 1) $purchaseString = "Purchases";
                                    ?>
                                    <form method="post" action="people.php?action=add&imageID=<?php echo $imageID ?>" class="ui column raised card">
                                        <div class="ui blurring dimmable image">
                                            <div class="ui dimmer">
                                                <div class="content">
                                                    <div class="center">
                                                    <a><button type="submit" class="ui inverted green button"><i class="cart icon"></i>Add to cart</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <img src="<?php echo "images/MARKED_".$imagePath; ?>">
                                        </div>
                                        <div class="content">
                                            <h3 class="left aligned header"><?php echo $imageName; ?></h3>
                                            <div class="right floated meta">
                                                
                                                <p class="ui green tag label"><?php echo "$credits $creditString"; ?></p>
                                            </div>
                                            <div class="left aligned">
                                                
                                                <span><em>by <?php echo $photographer; ?></em></span>
                                            </div>
                                            <div class="left aligned description"><?php echo $category; ?> 
                                            </div>
                                        </div>
                                        <div class="extra content">
                                            <span class="left floated">
                                                <i class="users icon"></i>
                                                <?php echo "$purchases $purchaseString"; ?>
                                            </span>
                                        </div>
                                    </form>
                                <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <!-- DIVIDER -->
            <div class="ui horizontal divider container">
                VIEW ALL PEOPLE PHOTOS
            </div>

            <!-- ALL FPEOPLE PHOTOS -->
            <div class="ui four center aligned doubling stackable container cards">

                <?php 
                    // for ($i = 1; $i <= 16; $i++) { 
                    $imageProduct = query("SELECT * FROM imageInfo WHERE category = 'people';");
                    if(!empty($imageProduct)) {
                        foreach($imageProduct as $key => $value) {
                            $imageID = $imageProduct[$key]['imageID'];
                            $imageName = $imageProduct[$key]['imageName'];
                            $category = $imageProduct[$key]['category'];
                            $imagePath = $imageProduct[$key]['imagePath'];
                            $photographer = $imageProduct[$key]['photographer'];
                            $credits = $imageProduct[$key]['credits'];
                            $uploader = $imageProduct[$key]['uploader'];
                            $purchases = $imageProduct[$key]['purchases'];
                            
                            // Add watermark to the image
                            // $watermarked = addWatermark($imagePath, "MARKED_".$imagePath);
                            
                            // Plurals
                            $creditString = "credit";
                            $purchaseString = "Purchase";
                            if ($credits > 1) $creditString = "credits";
                            if ($purchases > 1) $purchaseString = "Purchases";
                ?>
                        <form method="post" action="people.php?action=add&imageID=<?php echo $imageProduct[$key]["imageID"]?>" class="ui column raised card">
                            <div class="ui blurring dimmable image">
                                <div class="ui dimmer">
                                    <div class="content">
                                        <div class="center">
                                        <a><button type="submit" class="ui inverted green button"><i class="cart icon"></i>Add to cart</button></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- <img src="https://picsum.photos/250"> -->
                                <img src="<?php echo "images/MARKED_".$imagePath; ?>">
                            </div>
                            <div class="content">
                                <h3 class="left aligned header"><?php echo $imageName ?></h3>
                                <div class="right floated meta">
                                    
                                    <p class="ui green tag label"><?php echo "$credits $creditString" ?></p>
                                </div>
                                <div class="left aligned">
                                    
                                    <span><em>by <?php echo $photographer ?></em></span>
                                </div>
                                <div class="left aligned description"><?php echo $category ?> 
                                </div>
                            </div>
                            <div class="extra content">
                                <span class="left floated">
                                    <i class="users icon"></i>
                                    <?php echo "$purchases $purchaseString" ?>
                                </span>
                            </div>
                        </form>
                <?php 
                        } 
                    }
                ?>
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