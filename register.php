<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mika — Register</title>
    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <section id="register">
        <div class="ui middle aligned center aligned grid">
            <div class="column">
                <div class="ui center aligned header">
                    <h1>Register</h1>
                </div>
                <form class="ui large form" action="index.php" method="post">
                    <div class="ui stacked left aligned segment">
                        <div class="field">
                            <label>First Name</label>
                            <input type="text" name="firstName" placeholder="First Name">
                        </div>
                        <div class="field">
                            <label>Last Name</label>
                            <input type="text" name="lastName" placeholder="Last Name">
                        </div>
                        <div class="field">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Username">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password1" placeholder="Password">
                        </div>
                        <div class="field">
                            <label>Confirm Password</label>
                            <input type="password" name="password2" placeholder="Confirm Password">
                        </div>
                        <div class="field">
                            <input class="ui large fluid teal submit button" type="submit" value="Register" name="register">
                        </div>
                    </div>
                </form>
                <div class="ui message">
                    Have an account already? <a href="login.php">Log in here.</a>
                </div>
                <a href="index.php">    
                    <button class="ui fluid large primary button">
                        <i class="home icon "></i>
                        Home
                    </button>
                </a>
            </div>
        </div>
    </section>
    
</body>
</html>
