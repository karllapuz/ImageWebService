<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <title>Images</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>

    <form action="account.php" method="post">
        Log Out <br>
        <input type="submit" name="logout" value="Log Out">
    </form>

    <form action="account.php" method="post">
        Delete Account <br>
        <input type="submit" name="delete-account" value="Delete Account">
    </form>

    <form action="uploadImage.php" method="post" enctype="multipart/form-data">
        Select Image File to Upload:
        <input type="file" name="image"> <br>
        <input type="text" name="imageName" placeholder="Image Name"> <br>
        <input type="text" name="category" placeholder="Category"> <br>
        <input type="text" name="photographer" placeholder="Photographer"> <br>
        <input type="submit" name="submit" value="Upload">
    </form>
    
</body>
</html>

<?php
    // Connection credentials
    session_start();
    require_once('connection.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    // echo "Current session: " . $_SESSION['username'];

    // Establish connection
    $db = new mysqli($hn, $un, $pw, $db);
    if($db->connect_error) die($db->connect_error);

    // POST request for when submit button is clicked
    if(isset($_POST["submit"])){
        // Image resolution
        $resolution = getimagesize($_FILES["image"]["tmp_name"]);
        $image_resolution = $resolution[3];

        // Image size in bytes
        $size = filesize($_FILES["image"]["tmp_name"]);

        // Target path where we store the images
        $target = "images/".basename($_FILES['image']['name']);

        // Image path
        $image = $_FILES['image']['name'];

        // Full image path to move to images folder
        $fullImageName = "images/".$image;

        // Fetch image name from form
        $imageName = mysqli_real_escape_string($db, $_POST['imageName']);

        // Fetch image category from form
        $category = mysqli_real_escape_string($db, $_POST['category']);

        // Fetch image photographer from form
        $photographer = mysqli_real_escape_string($db, $_POST['photographer']);

        // INSERT query
        $query = $db->query("INSERT into imageInfo (imageName, category, imagePath, resolution, size, photographer) 
            VALUES ('$imageName', '$category', '$image', '$image_resolution', '$size', '$photographer')");

        // Save image file to images folder
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image upload successful";
        } else {
            $msg = "Image upload failed";
        }
    }

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

    // DISPLAY query
    $display = "SELECT * FROM imageInfo";
    $result = $db->query($display);
    if(!$result) die($db->error);
    $rows = $result->num_rows;
    for($j = 0; $j < $rows; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        // Build div displaying image information with the fetched date from imageInfo
        echo "<div id = 'img_div'>";
            echo "<img id='image' src='images/".$row['imagePath']."'>";
        echo "</div>";
        echo "Image Name: " . $row['imageName'] . "<br>";
        echo "Category: " . $row['category'] . "<br>";
        echo "Photographer: " . $row['photographer'] . "<br>";
        echo "Image resolution: " . $row['resolution'] . "<br>";
        echo "Image resolution: " . $row['size'] . " bytes<br>";
        echo "Image path: " . $row['imagePath'] . "<br>";

        // Delete button
        echo "<form action='uploadImage.php' method='POST'>";
            echo "<input type='hidden' name='delete' value='yes'>";
            echo "<input type='hidden' name='imageID' value='". $row['imageID'] ."'>";
            // echo "<input type='submit' value='PURCHASE'>";
            echo "<input type='submit' value='DELETE'>";
        echo "</form>";

        // Purchase button
        echo "<form action='uploadImage.php' method='POST'>";
            echo "<input type='hidden' name='purchase' value='yes'>";
            echo "<input type='hidden' name='imageID' value='". $row['imageID'] ."'>";
            // echo "<input type='submit' value='PURCHASE'>";
            echo "<input type='submit' value='PURCHASE'>";
        echo "</form>";
    }

    // DISPLAY TRANSACTION query
    $username = $_SESSION['username'];
    $displayTransaction = "SELECT * FROM transaction WHERE username = '$username';";
    // echo $displayTransaction;
    $resultTransaction = $db->query($displayTransaction);
    if(!$resultTransaction) die($db->error);
    $rows = $resultTransaction->num_rows;
    for($j = 0; $j < $rows; ++$j) {
        $resultTransaction->data_seek($j);
        $row = $resultTransaction->fetch_array(MYSQLI_ASSOC);

        // Build div displaying image information with the fetched date from imageInfo
        echo "Image ID: " . $row['imageID'] . "<br>";
        echo "Timestamp: " . $row['ts'] . "<br>";

        // Delete button
        echo "<form action='uploadImage.php' method='POST'>";
            echo "<input type='hidden' name='delete-transaction' value='yes'>";
            echo "<input type='hidden' name='imageID' value='". $row['imageID'] ."'>";
            echo "<input type='hidden' name='ts' value='". $row['ts'] ."'>";
            // echo "<input type='submit' value='PURCHASE'>";
            echo "<input type='submit' value='DELETE TRANSACTION'>";
        echo "</form>";
    }

    // DELETE request
    if(isset($_POST['delete']) && isset($_POST['imageID']))  {
        $imageID = mysqli_real_escape_string($db, $_POST['imageID']);
        $delete = $db->query("DELETE FROM imageInfo WHERE imageID = '$imageID'");
    }

    // DELETE TRANSACTION request
    if(isset($_POST['delete-transaction']) && isset($_POST['imageID']) && isset($_POST['ts']))  {
        $imageID = mysqli_real_escape_string($db, $_POST['imageID']);
        $ts = mysqli_real_escape_string($db, $_POST['ts']);
        $delete = $db->query("DELETE FROM transaction WHERE imageID = '$imageID' AND ts = '$ts'");
    }

    // PURCHASE request
    if(isset($_POST['purchase']) && isset($_POST['imageID']))  {
        $imageID = mysqli_real_escape_string($db, $_POST['imageID']);
        $username = $_SESSION['username'];
        $purchase = $db->query("INSERT into transaction (username, imageID, ts) 
            VALUES ('$username', '$imageID', NOW())");
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: account.php");
    }

    // DELETE ACCOUNT request
    if(isset($_POST['delete-account']))  {
        $username = $_SESSION['username'];
        $deleteAccount = $db->query("DELETE FROM customer WHERE username = '$username';");
    }
    
    
?>

