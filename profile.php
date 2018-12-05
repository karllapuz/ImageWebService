<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
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
                    <img src="assets/logo/MikaLogo.png" alt="Logo">
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
                        <p><strong>Welcome, Michelle</strong></p>
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

        <!-- GALLERY HEADER TEXT -->
        <div class="ui center aligned header">
            <h1>Account</h1>
        </div>

        <!-- ACCOUNT INFO -->
        <div class="ui center aligned container">
            <h2 class="ui center aligned icon header">
                <div class="ui container">
                    <i class="inverted circular user icon"></i>
                    Michelle Luong
                </div>
                <span><em><h3>@imichellexo</h3></em></span>
                <!-- RENDERED IF USER IS SELLER -->
                <span class="ui green label">Certified Seller</span>
            </h2>
            <div class="ui container buttons">
                <div class="ui animated teal button" tabindex="0">

                    <!-- RENDERED IF USER IS SELLER  -->
                    <div class="visible content">
                        Upload a Photo
                    </div>
                    <div class="hidden content">
                        <i class="upload icon"></i>
                    </div>

                    <!-- RENDERED IF USER IS NOT SELLER  -->
                    <!-- <div class="visible content">
                        Become a Seller
                    </div>
                    <div class="hidden content">
                        <i class="image icon"></i>
                    </div> -->


                </div>
                <div class="ui animated negative button" tabindex="0">
                    <div class="visible content">
                        Delete Account
                    </div>
                    <div class="hidden content">
                        <i class="trash alternate icon"></i>
                    </div>
                </div>
            </div>
        </div>


        
    </section>

    <script>
        
    </script>
</body>
</html>