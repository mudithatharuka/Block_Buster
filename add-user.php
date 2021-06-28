<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>

<?php

	$errors = array();
	
	$name = '';
	$email = '';
	$password = '';
	$profile_photo = '';


	if(isset($_POST['sign'])){

		$name = $_POST['name'];
		$email = $_POST['email'];

		
		//Checking required fields
		$req_fields =array('name','email','password');
		$errors = array_merge($errors, check_req_fields($req_fields));
		
		//Checkin required images
		$req_images =array('profile_photo');
		$errors = array_merge($errors, check_req_images($req_images));


		//Checking max length
		$max_len_fields =array('name' => 50 ,'email' => 100,'password' => 40);
		$errors = array_merge($errors, check_max_len($max_len_fields));
		 

		//Checking email address
		if(!is_email($_POST['email'])){
			$errors[] ='Email address is invalid';
		}

		//Checking if email address is already exist
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";

		$result_set = mysqli_query($connection,$query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				$errors[] = 'Email address already exist';
			}
		}

		if(empty($errors)){
			//No errors found.. Adding to tha database
			$name = mysqli_real_escape_string($connection,$_POST['name']);
			//email is already sanitized
			$password = mysqli_real_escape_string($connection,$_POST['password']);

			$hashed_password = sha1($password);


			//Getting the user_id of the lastly added user for make a directory for images
			$query = "SELECT * FROM users_seq ORDER BY user_id DESC LIMIT 1";

			$result_set = mysqli_query($connection, $query);

			if($result_set){
				if(mysqli_num_rows($result_set) == 1){
					//Last user_id retrived 
					$user = mysqli_fetch_assoc($result_set);
					$id = $user['user_id'];
					$id++;
					if($id > 1 && $id < 10){
						$user_id = "USR_00{$id}";
					}elseif ($id > 9 && $id < 100) {
						$user_id = "USR_0{$id}";
					}elseif ($id > 99) {
						$user_id = "USR_{$id}";
					}
					
				}else{
					$id = 1;
					$user_id = "USR_00{$id}";
				}
			}else{
				$errors[] = 'Retriving last user id database query faild';
			}


			$curdir = getcwd();
			mkdir($curdir."/Post_images/Users/{$user_id}", 0777);	

			$target = "Post_images/Users/{$user_id}/".basename($_FILES['profile_photo']['name']);

			$profile_photo = $_FILES['profile_photo']['name'];




			$query = "INSERT INTO  users(name,email,password,p_photo,is_deleted) VALUES ('{$name}','{$email}','{$hashed_password}','{$profile_photo}',0)";

			

			$result = mysqli_query($connection,$query);

			if($result){
				//Query successful

				if(move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target)){

					header('Location:users.php?user_added_sucessfully=true');

				}else{
					$errors[] = 'Adding failed. Uploded immages did not saved';
				}

			}else{
				//Query unsucessful
				$errors[] = 'Database query failed';
			}
		
	}
		
	}

?>
<!-- Sign Up Process Over -->


<!DOCTYPE html>
<html>
<head>
	<title>BLOCK BUSTER > Admin</title>
	<link rel="stylesheet" type="text/css" href="css/add-movie-tvseries.css">
</head>
<body>

	<?php require_once('inc/adminheader.php') ?>

	<div class="Content">
		<h1>Add Users</h1>
		<a href="users.php"> <-Back to list</a>
		<div class="balance"></div>

		<?php
			if(!empty($errors)){
				display_errors($errors);
			}
		?>

		<form method="post" action="add-user.php" enctype="multipart/form-data">
			
			<div class="Add-user">
					
					<p><label>Name:</label>
					<input type="text" name="name" placeholder="  Name" <?php echo 'value="' .$name. '"'; ?>>
					</p><div class="balance"></div>

					<p><label>User Email:</label>
					<input type="text" name="email" placeholder="  Email" <?php echo 'value="' .$email. '"'; ?>>
					</p><div class="balance"></div>

					<p><label>Password:</label>
					<input type="text" name="password" placeholder="  Password">
					</p><div class="balance"></div>
					
					<p><label>Profile Photo:</label>
					<input type="file" name="profile_photo" accept="image/*">
					</p><div class="balance"></div>
					
					<div class="sign"><button name="sign" id="sign">SIGN UP</button></div>
				
			</div><!-- Add-user -->
			

		</form>
	</div><!-- Content -->

</body>
</html>
<?php mysqli_close($connection); ?>