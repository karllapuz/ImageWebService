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
	
			$query = "INSERT INTO customer (customerID, username, password, firstName, lastName, userType) 
					  VALUES(NULL, '$username', '$password', '$firstName', '$lastName', 'user')";
            $results = mysqli_query($db, $query);
            // echo $query;

            $_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
    }


?>