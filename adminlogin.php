<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php

	$errors = array();

	$email ='';

	if(isset($_POST['adminlogin'])){

		$email = $_POST['email'];

		//Checking if the email and password is entered
		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){
			$errors[] = 'Email is missing or invalid';
		}
		if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
			$errors[] = 'Password is missing or invalid';
		}

		//Checking if there are errors in the form
		if(empty($errors)){

			$email = mysqli_real_escape_string($connection, $_POST['email']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password= sha1($password);

		//Database query
		$query = "SELECT * FROM admins WHERE email ='{$email}' AND password ='{$hashed_password}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

			if($result_set){
				if(mysqli_num_rows($result_set) == 1){
					//Valid user found
					$admin =mysqli_fetch_assoc($result_set);
					$_SESSION['admin_id'] = $admin['admin_id'];
					$_SESSION['name'] = $admin['name'];
					//Update last login
					$query = "UPDATE admins SET last_login = NOW() WHERE admin_id = '{$_SESSION['admin_id']}' LIMIT 1";
					$result_set = mysqli_query($connection, $query);

					if(!$result_set){
						
						die("Database query failed");
					}

					//Redirect to adminhome.php
					header('Location:adminhome.php');
				}else{
					//Email or password invalid
					$errors[] = 'Invali Email /  Password';
				}
			}else{
				$errors[] = 'Database query faild';
			}	
		}

	}

?>




<!DOCTYPE html>
<html>
<head>
	<title>BLOCK BUSTER - Admin</title>
	<link rel="stylesheet" type="text/css" href="css/adminlogin.css">
</head>
<body>
	<div class="Wrapper">
		
		<div class="Background clearfix">
			
			<div class="Login">
				
				<h1>BLOCK BUSTER</h1>
				<h3>WELCOME ADMIN</h3>

				<div class="Loginform">
					<form method="post" action="adminlogin.php">
						<h2>ADMIN LOGIN</h2>

						<?php

							if(isset($errors) && !empty($errors)){
								echo '<p class="error">Invalid Email / Password</p>';
							}

							if(isset($_GET['has_logged'])){
								echo '<p class="error">You Must First Log In</p>';
							}

							if(isset($_GET['new_admin_added'])){
								echo '<p class="cool">Successfully Registered. Please Log in Admin</p>';
							}

							if(isset($_GET['logout'])){
								echo '<p class="cool">Successfully Logged Out From the System</p>';
							}

						?>

						<label>ADMIN EMAIL:</label><br>
						<input type="email" name="email" placeholder="  Email" <?php echo 'value="' . $email . '"'; ?>><br>
						<label>ADMIN PASSWORD:</label><br>
						<input type="password" name="password" placeholder="  Password"><br>
						<button name="adminlogin">LOG IN</button>
					</form>
				</div><!--Loginform-->

			</div><!--Login-->

		</div><!--Background-->

	</div><!--Wrapper-->
</body>
</html>
<?php mysqli_close($connection); ?>