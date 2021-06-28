<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>

<?php



	if(isset($_GET['cbr_id'])){
		$cel_id = mysqli_real_escape_string($connection, $_GET['cbr_id']);
		$query = "SELECT * FROM celebrities WHERE cbr_id = '{$cel_id}' AND is_deleted = 0 LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//Celebrity found
				//Deleting the movie
				$query = "UPDATE celebrities SET is_deleted = 1 WHERE cbr_id = '{$cel_id}' LIMIT 1";
				$result = mysqli_query($connection, $query);

				if($result){
					//Celebrity deleted
					header('Location:celebrity.php?celebrity_deleted=true');
				}else{
					header('Location:celebrity.php?celebrity_deleted=false');
				}

			}else{
				//Celebrity not found
				header('Location:celebrity.php?celebrity_found=false');
			}
		}else{
			//Queru unsuccessful
			header('Location:celebrity.php?query_successful=false');
		}
	}else{
		header('Location:celebrity.php?set_celebrity_id=false');
	}
	 
	

	
?>


<?php mysqli_close($connection); ?>