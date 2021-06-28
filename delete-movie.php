<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>

<?php



	if(isset($_GET['movie_id'])){
		$mov_id = mysqli_real_escape_string($connection, $_GET['movie_id']);
		$query = "SELECT * FROM movies WHERE movie_id = '{$mov_id}' AND is_deleted = 0 LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//Movie found
				//Deleting the movie
				$query = "UPDATE movies SET is_deleted = 1 WHERE movie_id = '{$mov_id}' LIMIT 1";
				$result = mysqli_query($connection, $query);

				if($result){
					//Movie deleted
					header('Location:adminhome.php?movie_deleted=true');
				}else{
					header('Location:adminhome.php?movie_deleted=false');
				}

			}else{
				//Movie not found
				header('Location:adminhome.php?movie_found=false');
			}
		}else{
			//Queru unsuccessful
			header('Location:adminhome.php?query_successful=false');
		}
	}else{
		header('Location:adminhome.php?set_movie_id=false');
	}
	 
	

	
?>


<?php mysqli_close($connection); ?>