<?php
    session_start();

    // Database Credentials
    $db = mysqli_connect('localhost', 'mika', 'sesame', 'mika');
    // if($db->connect_error) die($db->connect_error); else echo "Connected";
    
    $errors = array();
    $firstName = "";
    $lastName = "";
    $username = "";

	// Query function
	function query($query) {
        $connect = mysqli_connect('localhost', 'mika', 'sesame', 'mika');
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $set[] = $row;
        } 
        if(!empty($set)) {
            return $set;
        }
	}
	
	// CUSTOMER DATABASE
	// Register a user
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
					  VALUES(NULL, '$username', '$password', '$firstName', '$lastName', 'consumer', 20)";
            $results = mysqli_query($db, $query);
            // echo $query;

            $_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: gallery.php');
		}
    }

	// Logs in a user
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

	// Converts a user from consumer to seller
	if(isset($_POST['becomeSeller'])) {
		$username = $_SESSION['username'];
		$becomeSellerQuery = "UPDATE customer SET userType = 'seller' WHERE username = '$username';";
		// echo $becomeSellerQuery;
		$r = mysqli_query($db, $becomeSellerQuery); 
	}

	// Add credits to account 
	if (isset($_POST['add_credits'])) {
		$username = $_SESSION['username'];
		$query = "UPDATE customer SET credits = credits + 1 WHERE username = '$username';";
		$r = mysqli_query($db, $query); 
	}

	// Delete account 
	if (isset($_POST['delete_account'])) {
		$username = $_SESSION['username'];
		$query = "DELETE FROM customer WHERE username='$username';";
		session_unset();
		$r = mysqli_query($db, $query); 
		header("Location: index.php");
	}
	
	// IMAGES DATABASE
	$image_link = "";
	$image_name = "";
	$category = "";
	$photographer = "";
	$credits = 1;
	
	// Uploads an image to the gallery
	if (isset($_POST['upload_image'])) {

		// Fetch inputs
        $image_link = $_FILES['image']['name'];
        $image_name = mysqli_real_escape_string($db, $_POST['image_name']);
        $category = mysqli_real_escape_string($db, $_POST['category']);
		$photographer = mysqli_real_escape_string($db, $_POST['photographer']);
        $credits = mysqli_real_escape_string($db, $_POST['credits']);
        
        // Form Validation
        if (empty($image_link)) { array_push($errors, "Upload file is required"); }
        if (empty($image_name)) { array_push($errors, "Name of image is required"); }
		if (empty($category)) { array_push($errors, "Please specify a category"); }
		if (empty($photographer)) { array_push($errors, "Photographer name is required"); }
		if (empty($credits)) { array_push($errors, "Please specify credits for the image"); }
        
        
        // If no errors, proceed to register user
		if (count($errors) == 0) {
			$username = $_SESSION['username'];
			$query = "INSERT INTO imageInfo (imageID, imageName, category, imagePath, photographer, credits, uploader, purchases) 
							VALUES(NULL, '$image_name', '$category', '$image_link', '$photographer', '$credits', '$username', 0)";
			$results = mysqli_query($db, $query);
			addWatermark($image_link, "MARKED_".$image_link);
			$target = "images/".basename($_FILES['image']['name']);
				// Save image file to images folder
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
					$msg = "Image upload successful";
				} else {
					$msg = "Image upload failed";
				}
		}
	}
	
	function addWatermark($image, $fileNameOut) {

		$watermark = imagecreatefrompng("assets/images/watermark.png");

		list($widthWatermark, $heightWatermark) = getimagesize("assets/images/watermark.png");
		list($widthBackground, $heightBackground) = getimagesize("images/".$image);

		// Centers the watermark
		$xPos = ($widthBackground / 2) - ($widthWatermark / 2);
		$yPos = ($heightBackground / 2) - ($heightWatermark / 2);

		// Scales the watermark with the background's size
		// $ratio = $widthWatermark / $heightWatermark;
		// if ($widthBackground / $heightBackground > $ratio) {
		//     $newwidth = $heightBackground * $ratio;
		//     $newheight = $heightBackground;
		// } else {
		//     $newheight = $widthBackground / $ratio;
		//     $newwidth = $widthBackground;
		// }

		// $final = imagecreatetruecolor($newwidth, $newheight);
		// imagecopyresampled($final, $watermark, 0, 0, 0, 0, $newwidth, $newheight, $widthWatermark, $heightWatermark);

		// $watermark = $final;

		$backgroundImage = imagecreatefromjpeg("images/".$image);

		$watermarkImageWidth = imagesx($watermark);
		$watermarkImageHeight = imagesy($watermark);

		for ($x = 0; $x < $watermarkImageWidth; ++$x) {
			for ($y = 0; $y < $watermarkImageHeight; ++$y) {
				

				// Get the color index of a position in both images
				$rgbaForeground = imagecolorat($watermark, $x, $y);

				// Get each value or rgb from index
				$r = ($rgbaForeground >> 16) & 0xFF;
				$g = ($rgbaForeground >> 8) & 0xFF;
				$b = $rgbaForeground & 0xFF;
				$a = ($rgbaForeground >> 24) & 0x7F;

				$color = imagecolorallocatealpha($watermark, $r, $g, $b, $a);
				// Set the color to be embedded in the picture in the in the position indicated
				imagesetpixel($backgroundImage, $x + $xPos, $y + $yPos, $color);
			}
		}
		imagejpeg($backgroundImage, "images/".$fileNameOut);
		return $fileNameOut;
	}

	// TRANSACTIONS DATABASE

	// Purchase items
	if (isset($_POST['purchase_items'])) {
		if(isset($_SESSION["cart"])) {
			$username = $_SESSION['username'];
			$totalCredits = 0;
			foreach ($_SESSION["cart"] as $product)
			{
				$imageID = $product["imageID"];
				$imageCredit = $product["credits"];
				$imagePurchases = $product["purchases"];
				$totalCredits += $imageCredit;
				$query = "INSERT INTO transaction (transactionID, username, imageID) 
						VALUES(NULL, '$username', '$imageID');";
				mysqli_query($db, $query);
				$query = "UPDATE imageInfo SET purchases = purchases + 1 WHERE imageID = '$imageID';";
				mysqli_query($db, $query);
				// $quantity = $product["quantity"];
				// $item_weight = $product["item_weight"];
				// $item_total_weight = $item_weight * $quantity;
				// $suffix = "lbs";
				// if ($item_total_weight <= 1) {
				// 	$suffix = "lb";
				// }
			}
			$creditQuery = "UPDATE customer SET credits = credits - $totalCredits WHERE username = '$username';";
			$r = mysqli_query($db, $creditQuery); 
			unset($_SESSION['cart']);
	  	}
	}

	// Display photos bought by the user
	function show_purchased_images() {

		// Fetch all the photo ID's from the transaction with specific user
		$username = $_SESSION['username'];
		$imagesQuery = "SELECT * FROM imageInfo JOIN transaction ON transaction.imageID = imageInfo.imageID
						WHERE username = '$username';";
		$images = query($imagesQuery);
		if (!empty($images)) {
			foreach($images as $key => $value)
			{
				$image_name = $images[$key]["imageName"];
				$category = $images[$key]["category"];
				$image = $images[$key]["imagePath"];
				$photographer = $images[$key]["photographer"];
				
				echo "<div class='ui column raised card'>
						<div class='ui blurring dimmable image'>
							<div class='ui dimmer'>
								<div class='content'>
									<div class='center'>
										<a target='_blank' href='images/$image' download><div class='ui inverted primary button'><i class='download icon'></i>Download</div></a>
									</div>
								</div>
							</div>
							<img src='images/$image'>
						</div>
						<div class='content'>
							<h3 class='left aligned header'>$image_name</h3>
							<div class='right floated meta'>
								<div class='left aligned description'>
									$category
								</div>
							</div>
							<div class='left aligned'>
								<span><em>by $photographer</em></span>
							</div>
						</div>
					</div>";
			}
		}
		else {
			echo "<p>No photos purchased. Browse the gallery to buy some amazing photos!</p>";
		}

	}
	
	

?>