<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>

<?php

	$errors = array();

	$name = '';
	$email = '';
	$contact = '';
	$password = '';

	if(isset($_POST['adminsignup'])){

		$name = $_POST['name'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$password = $_POST['password'];

		//Checking required fields
		$req_fields =array('name','email','contact','password');
		$errors = array_merge($errors, check_req_fields($req_fields));
		

		//Checking max length
		$max_len_fields =array('name' => 50 ,'email' => 100,'contact' => 15,'password' => 40);
		$errors = array_merge($errors, check_max_len($max_len_fields));
		 

		//Checking email address
		if(!is_email($_POST['email'])){
			$errors[] ='Email address is invalid';
		}

		//Checking if email address is already exist
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM admins WHERE email = '{$email}' LIMIT 1";

		$result_set = mysqli_query($connection,$query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				$errors[] = 'Email address already exist;';
			}
		}


		if(empty($errors)){
			//No errors found.. Adding to tha database
			$name = mysqli_real_escape_string($connection,$_POST['name']);
			//email is already sanitized
			$contact = mysqli_real_escape_string($connection,$_POST['contact']);
			$password = mysqli_real_escape_string($connection,$_POST['password']);

			$hashed_password = sha1($password);

			$query = "INSERT INTO  admins(name,email,contact_no,password,is_deleted) VALUES ('{$name}','{$email}','{$contact}','{$hashed_password}',0)";

			

			$result = mysqli_query($connection,$query);

			if($result){
				//Query successful.. New admin added
				header('Location: adminlogin.php?new_admin_added=true');
			}else{
				$errors[] = 'Failed to add a new admin. Try again later.';
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
			
			<div class="Signup">
				
				<h1>BLOCK BUSTER</h1>
				<h3>WELCOME NEW ADMIN</h3>

				<div class="Signupform">
					<form method="post" action="adminsignup.php">
						<h2>ADMIN SIGNUP</h2>

						<?php
							if(!empty($errors)){
								display_errors($errors);
							}
						?>

						<label>NAME:</label><br>
						<input type="text" name="name" placeholder="  Name" <?php echo 'value="' . $name . '"'; ?>><br>
						<label>EMAIL:</label><br>
						<input type="text" name="email" placeholder="  Email" <?php echo 'value="' . $email . '"'; ?>><br>
						<label>CONTACT NO:</label><br>
						<input type="number" name="contact" placeholder="  Phone" <?php echo 'value="' . $contact . '"'; ?>><br>
						<label>PASSWORD:</label><br>
						
						<input type="password" name="password" placeholder="  Password" ><br>
						<button name="adminsignup">SIGN UP</button>
					</form>
				</div><!--Signupform-->

			</div><!--Signup-->

		</div><!--Background-->

	</div><!--Wrapper-->
</body>
</html>
<?php mysqli_close($connection); ?>