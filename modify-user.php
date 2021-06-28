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
	
	$usr_id = '';
	$name = '';
	$email = '';
	$password = '';
	$profile_photo = '';

	if(isset($_GET['user_id'])){
		$usr_id = mysqli_real_escape_string($connection, $_GET['user_id']);
		$query = "SELECT * FROM users WHERE user_id = '{$usr_id}' LIMIT 1 ";

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//User found
				$result = mysqli_fetch_assoc($result_set);

				$name = $result['name'];
				$email = $result['email'];
			}else{
				//User not found
				header('Location:users.php?user_found=false');
			}
		}else{
			//Queru unsuccessful
			header('Location:users.php?query_successful=false');
		}
	}
	// else{

	// 	 //header('Location:users.php?set_user_id=false');
	// }

	if(isset($_POST['save'])){

		$usr_id = $_POST['usr_id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		
		//Checking required fields
		$req_fields =array('usr_id', 'name','email');
		$errors = array_merge($errors, check_req_fields($req_fields));
		
		//Checkin required images
		$req_images =array('profile_photo');
		$errors = array_merge($errors, check_req_images($req_images));


		//Checking max length
		$max_len_fields =array('name' => 50 ,'email' => 100);
		$errors = array_merge($errors, check_max_len($max_len_fields));
		 

		//Checking email address
		if(!is_email($_POST['email'])){
			$errors[] ='Email address is invalid';
		}

		//Checking if email address is already exist
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM users WHERE email = '{$email}' AND user_id != '{$usr_id}' LIMIT 1";

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
			
			$profile_photo = $_FILES['profile_photo']['name'];

			$target = "Post_images/Users/{$usr_id}/".basename($_FILES['profile_photo']['name']);


			$query = "UPDATE users SET name ='{$name}', email = '{$email}', p_photo = '{$profile_photo}' WHERE user_id = '{$usr_id}' LIMIT 1 ";

			
			$result = mysqli_query($connection, $query);

			if($result){
				//Query successful

				if(move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target)){

					header('Location:users.php?user_modified_sucessfully=true');

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

	<header>
		<div class="Sitename">BLOCK BUSTER</div><!--Sitename-->
		<div class="Loggedin">Welcome Admin <?php echo $_SESSION['name'];?>! <a href="adminlogout.php">Log Out</a></div>
	</header>

	<div class="Content">
		<h1>View / Modify Users</h1>
		<a href="users.php"> <-Back to list</a>
		<div class="balance"></div>

		<?php
			if(!empty($errors)){
				display_errors($errors);
			}
		?>

		<form method="post" action="modify-user.php" enctype="multipart/form-data">
			
			<div class="Add-user">
					<input type="hidden" name="usr_id" value="<?php echo $usr_id; ?>">

					<p><label>Name:</label>
					<input type="text" name="name" placeholder="  Name" <?php echo 'value="' .$name. '"'; ?>>
					</p><div class="balance"></div>

					<p><label>User Email:</label>
					<input type="text" name="email" placeholder="  Email" <?php echo 'value="' .$email. '"'; ?>>
					</p><div class="balance"></div>

					<p><label>Password:</label>
					 | <span>********</span>  <a style="margin-right: 1%;font-size: 16px; float: left;" href="change-password.php">Change Password</a>
					</p><div class="balance"></div>
					
					<p><label>Profile Photo:</label>
					<input type="file" name="profile_photo" accept="image/*">
					</p><div class="balance"></div>
					
					<div class="sign"><button name="save" id="sign">Save Changes</button></div>
				
			</div><!-- Add-user -->
			

		</form>
	</div><!-- Content -->

</body>
</html>
<?php mysqli_close($connection); ?>