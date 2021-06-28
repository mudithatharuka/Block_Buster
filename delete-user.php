<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>

<?php



	if(isset($_GET['user_id'])){
		$usr_id = mysqli_real_escape_string($connection, $_GET['user_id']);
		$query = "SELECT * FROM users WHERE user_id = '{$usr_id}' AND is_deleted = 0 LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//User found
				//Deleting the movie
				$query = "UPDATE users SET is_deleted = 1 WHERE user_id = '{$usr_id}' LIMIT 1";
				$result = mysqli_query($connection, $query);

				if($result){
					//User deleted
					header('Location:users.php?user_deleted=true');
				}else{
					header('Location:users.php?user_deleted=false');
				}

			}else{
				//User not found
				header('Location:users.php?user_found=false');
			}
		}else{
			//Queru unsuccessful
			header('Location:users.php?query_successful=false');
		}
	}else{
		header('Location:users.php?set_user_id=false');
	}
	 
	

	
?>


<?php mysqli_close($connection); ?>
