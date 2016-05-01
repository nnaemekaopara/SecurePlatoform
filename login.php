<?php
	session_start();
	include("connection.php"); //Establishing connection with our database
	
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			$error = "Both fields are required.";
		}else
		{

			//sanitize username input
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$username = stripcslashes($username);
			$username = htmlspecialchars($username);

			// Define and sanitize password input
			$password = md5(mysqli_real_escape_string($db, $_POST['password']));
			$password = stripcslashes($password);
			$password = htmlspecialchars($password);

			// Default values
			$total_failed_login = 3;
			$lockout_time       = 15;
			$account_locked     = false;


			//Check username and password from database
			$sql="SELECT userID FROM users WHERE username='$username' and password='$password'";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC) ;
			
			//If username and password exist in our database then create a session.
			//Otherwise echo error.
			
			if(mysqli_num_rows($result) == 1)
			{
				$_SESSION['username'] = $username; // Initializing Session
				header("location: photos.php"); // Redirecting To Other Page
			}else
			{
				$error = "Incorrect username or password.";
			}

		}
	}

?>