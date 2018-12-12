<?php

    include('server.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "logout":
                session_destroy();
                unset($_SESSION["username"]);
                header("location: index.php");
        }
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $firstName?>'s Profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section id="profile">

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
                <a class="item" href="gallery.php">
                    <i class="grid layout icon"></i>
                    Gallery
                </a>
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
                    <form method="post" action="profile.php" class="ui item">
                        <button type="submit" name="add_credits"class="ui right labeled icon green button">
                        <i class="plus icon"></i>
                            Credits: <?php echo $credits ?>
                        </button>
                    </form>
                    <div class="ui item">
                        <a class="ui negative button" href="gallery.php?action=logout">Log Out</a>
                    </div>
                </div>
            </div>
        </div>  

        <!-- GALLERY HEADER TEXT -->
        <div class="ui center aligned header">
            <h1>Account</h1>
        </div>

        <!-- ACCOUNT INFO -->
        <div class="ui center aligned container">
            <h2 class="ui center aligned icon header">
                <div class="ui container">
                    <i class="inverted circular user icon"></i>
                    <?php echo $firstName . " " . $lastName ?>
                </div>
                <span><em><h3>@<?php echo $username?></h3></em></span>
                <!-- RENDERED IF USER IS SELLER -->
                <?php if($userType == 'seller') { ?>
                    <span class="ui green label">Certified Seller</span>
                <?php } ?>
            </h2>
            <div class="ui container">
                
                <!-- RENDERED IF USER IS SELLER  -->
                <?php if($userType == 'seller') { ?>
                    <div id="uploadButton" class="ui animated teal button" tabindex="0">
                        <div class="visible content">
                            Upload a Photo
                        </div>
                        <div class="hidden content">
                            <i class="upload icon"></i>
                        </div>
                    </div>
                <?php } ?>

                <!-- RENDERED IF USER IS NOT SELLER  -->
                <?php if($userType == 'consumer') { ?>
                    <div id="sellerButton" class="ui animated teal button" tabindex="0">
                        <div class="visible content">
                            Become a Seller
                        </div>
                        <div class="hidden content">
                            <i class="image icon"></i>
                        </div> 
                    </div>
                <?php } ?>

                
                <div id="deleteButton" class="ui animated negative button" tabindex="0">
                    <div class="visible content">
                        Delete Account
                    </div>
                    <div class="hidden content">
                        <i class="trash alternate icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- MY PHOTOS -->
        <div class="ui photos center aligned container">
            <h2 class="ui teal top attached left aligned header">
                <i class="book icon"></i>
                <div class="content">
                    My Photos
                    <!-- <div class="sub header">
                        Content curated specifically for you based on the photos you've liked or purchased
                    </div> -->
                </div>    
            </h2>
            <div class="ui raised attached segment">
                <div class="ui four center aligned doubling stackable container cards">

                    <?php show_purchased_images(); ?>
                    
                </div>
            </div>
        </div>
        
        <!-- DELETE MODAL -->
        <div id="deleteModal" class="ui tiny modal">
            <div class="header">Delete Account</div>
            <div class="content">
                Are you sure you want to delete your account?
            </div>
            <form action="profile.php" method="post" class="actions">
                <div class="ui positive cancel button">No</div>
                <button name="delete_account" type="submit" class="ui negative approve right labeled icon button">Yes<i class="checkmark icon"></i> </button>
            </form>
        </div>

        <!-- SELLER MODAL -->
        <div id="sellerModal" class="ui tiny modal">
            <div class="header">Become a Seller</div>
            <div class="content">
                Are you sure you want to upgrade your account to be a seller?
            </div>
            <form action="profile.php" method="post" class="actions">
                <div class="ui negative cancel button">No</div>
                <!-- <button name="becomeSeller" class="ui positive approve right labeled icon button">Yes<i class="checkmark icon"></i> </button> -->
                <input class="ui positive approve right teal submit button" type="submit" value="Yes" name="becomeSeller">
            </form>
        </div>

        <!-- UPLOAD MODAL -->
        <div id="uploadModal" class="ui modal">
            <i class="close icon"></i>
            <div class="header">
                Upload a Photo
            </div>
            <div class="image content">
                <div class="image">
                    <img id="preview" src="assets/images/placeholder.jpg" alt="Preview">
                </div>
                <div class="description">
                    <form class="ui large form" action="profile.php" method="post" enctype="multipart/form-data">
                        <div class="field">
                            <label>Upload Image</label>
                            <input id="imgInp" type="file" name="image">
                        </div>
                        <div class="field">
                            <label>Image Name</label>
                            <input type="text" name="image_name" placeholder="Image Name">
                        </div>
                        <div class="field">
                            <label>Category</label>
                            <div class="ui selection dropdown">
                                <input type="hidden" name="category">
                                <i class="dropdown icon"></i>
                                <div class="default text">Category</div>
                                <div class="menu">
                                    <div class="item" data-value="Travel">Travel</div>
                                    <div class="item" data-value="Architecture">Architecture</div>
                                    <div class="item" data-value="People">People</div>
                                    <div class="item" data-value="Nature">Nature</div>
                                    <div class="item" data-value="Food">Food</div>
                                    <div class="item" data-value="Arts">Arts</div>
                                    <div class="item" data-value="Sports">Sports</div>
                                    <div class="item" data-value="Others">Others</div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Photographer</label>
                            <input type="text" name="photographer" placeholder="Name">
                        </div>
                        <div class="field">
                            <label>Credits</label>
                            <input type="number" class="credits" name="credits" placeholder="0" min="0">
                        </div>
                        <div class="field">
                            <input class="ui fluid teal submit button" type="submit" value="Upload Photo" name="upload_image">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>

    <script>
        $('.ui.dropdown').dropdown('show');
        $('.dimmable').dimmer({
            on: 'hover'
        });
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });
        $('#deleteButton').on('click', function() {
            $('#deleteModal')
                .modal('show');
        });
        $('#uploadButton').on('click', function() {
            $('#uploadModal')
                .modal('show');
        });
        $('#sellerButton').on('click', function() {
            $('#sellerModal')
                .modal('show');
        });
        $('.ui.form').form({
            fields: {
                image        : 'empty',
                image_name   : 'empty',
                category     : 'empty',
                photographer : 'empty',
                credits      : 'empty'
            }
        });
    </script>
</body>
</html>