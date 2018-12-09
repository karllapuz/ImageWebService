<?php
    session_start();

    // Database Credentials
    $db = mysqli_connect('localhost', 'mika', 'sesame', 'mika');
    // if($db->connect_error) die($db->connect_error); else echo "Connected";
    
    $errors = array();
    $firstName = "";
    $lastName = "";
    $username = "";

    if (isset($_POST['register'])) { 

        // Fetch inputs
        $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        
        // Form Validation
        if (empty($firstName)) { array_push($errors, "First Name is required"); }
        if (empty($lastName)) { array_push($errors, "Last Name is required"); }
		if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($password_1)) { array_push($errors, "Password is required"); }
        
        // Check if passwords match
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
        
        $usernameError = "SELECT * FROM customer WHERE username = '$username';";
		$usernameResults = mysqli_query($db, $usernameError);
		if(mysqli_num_rows($usernameResults) == 1) {
			array_push($errors, "Username already exists, please choose another username");
        }
        
        // If no errors, proceed to register user
		if (count($errors) == 0) {

			// Encrypt password before saving into database
			$password = sha1($password_1);
	
			$query = "INSERT INTO customer (customerID, username, password, firstName, lastName, userType, credits) 
					  VALUES(NULL, '$username', '$password', '$firstName', '$lastName', 'consumer', '35')";
            $results = mysqli_query($db, $query);
            // echo $query;

            $_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: gallery.php');
		}
    }

    if (isset($_POST['login'])) { 
        $username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
        
        // Form validation
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
        // If no errors, proceed to register user
		if (count($errors) == 0) {

			// Encrypt password before saving into database
			$password = sha1($password);
			$query = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: gallery.php');
			} 
			else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	if(isset($_POST['becomeSeller'])) {
		$username = $_SESSION['username'];
		$becomeSellerQuery = "UPDATE customer SET userType = 'seller' WHERE username = '$username';";
		// echo $becomeSellerQuery;
		$r = mysqli_query($db, $becomeSellerQuery); 
	}


?>