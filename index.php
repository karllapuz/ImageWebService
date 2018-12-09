<?php
    $pink = "pink";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mika</title>
    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section id="home">
        <div class="ui center aligned header">
            <div class="logo">
                <img src="assets/images/MikaLogo.png" alt="Logo">
            </div>
        </div>
        <div class="ui center aligned buttons container">
            <a href="login.php">
                <div class="ui large button">
                    Log in
                </div>
            </a>
            <a href="register.php">
                <div class="ui large green button">
                    Register
                </div>
            </a>
        </div>
    </section>

    <ul class="slideshow">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</body>
</html>