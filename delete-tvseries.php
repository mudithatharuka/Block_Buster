<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>

<?php



	if(isset($_GET['series_id'])){
		$seri_id = mysqli_real_escape_string($connection, $_GET['series_id']);
		$query = "SELECT * FROM tvseries WHERE series_id = '{$seri_id}' AND is_deleted = 0 LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//Series found
				//Deleting the series
				$query = "UPDATE tvseries SET is_deleted = 1 WHERE series_id = '{$seri_id}' LIMIT 1";
				$result = mysqli_query($connection, $query);

				if($result){
					//Series deleted
					header('Location:tvseries.php?user_deleted=true');
				}else{
					header('Location:tvseries.php?user_deleted=false');
				}

			}else{
				//Series not found
				header('Location:tvseries.php?user_found=false');
			}
		}else{
			//Queru unsuccessful
			header('Location:tvseries.php?query_successful=false');
		}
	}else{
		header('Location:tvseries.php?set_user_id=false');
	}
	 
	

	
?>


<?php mysqli_close($connection); ?>