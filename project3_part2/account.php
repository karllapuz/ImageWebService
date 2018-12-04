<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <title>Images</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>
    <form action="account.php" method="post">
        Create Account <br>
        <input type="text" name="username" placeholder="Username"> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="text" name="firstName" placeholder="First Name"> <br>
        <input type="text" name="lastName" placeholder="Last Name"> <br>
        <input type="text" name="userType" placeholder="Customer or Photographer?"> <br>
        <input type="submit" name="reg-customer" value="Create">
    </form>

    <form action="account.php" method="post">
        Log In <br>
        <input type="text" name="username" placeholder="Username"> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="submit" name="login" value="Log In">
    </form>
    
</body>
</html>

<?php
    session_start();
    require_once('connection.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    $db = new mysqli($hn, $un, $pw, $db);
    if($db->connect_error) die($db->connect_error);

    if(isset($_POST["reg-customer"])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password_raw = mysqli_real_escape_string($db, $_POST['password']);
        $password = sha1($password_raw);
        $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
        $userType = mysqli_real_escape_string($db, $_POST['userType']);

        // INSERT query
        $query = $db->query("INSERT into customer (username, password, firstName, lastName, userType) 
            VALUES ('$username', '$password', '$firstName', '$lastName', '$userType')");

    }

    if (isset($_POST['login'])) {
        // Fetch input values from login form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Encrypt password before saving into database
        $password = sha1($password);
        $query = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: uploadImage.php');
        }
	}


    
?>

