<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>
<?php

	$movies_list = '';
	$search = '';

	//Getting the movies
	if(isset($_GET['search'])){
		$search = mysqli_real_escape_string($connection, $_GET['search']);
		$query = "SELECT * FROM movies WHERE (movie_id LIKE '%{$search}%' OR admin_id LIKE '%{$search}%' OR m_name LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY movie_id DESC";
	}else{
		$query = "SELECT * FROM movies WHERE is_deleted = 0 ORDER BY movie_id DESC";	
	}

	$movies = mysqli_query($connection, $query);

	if($movies){

		if(mysqli_num_rows($movies) > 0){

			while ($movie = mysqli_fetch_assoc($movies)) {
				
				if($movie['l_u_date_time'] == ''){$movie['l_u_date_time'] = "Not modified";}
				if($movie['l_u_admin'] == ''){$movie['l_u_admin'] = "~-----~";}

				$movies_list.="<tr>";
				$movies_list.="<td>{$movie['movie_id']}</td>";
				$movies_list.="<td>{$movie['admin_id']}</td>";
				$movies_list.="<td>{$movie['m_name']}</td>";
				$movies_list.="<td>{$movie['relese_date']}</td>";
				$movies_list.="<td>{$movie['u_date']}</td>";
				$movies_list.="<td>{$movie['u_time']}</td>";
				$movies_list.="<td>{$movie['l_u_date_time']}</td>";
				$movies_list.="<td>{$movie['l_u_admin']}</td>";
				$movies_list.="<td><a href=\"modify-movie.php?movie_id={$movie['movie_id']}\"> <button class=\"edt\">Edit</button> </a></td>";
				$movies_list.="<td><a href=\"delete-movie.php?movie_id={$movie['movie_id']}\"
								onclick=\"return confirm('Are you sure you want to delete this record?');\"> <button class=\"del\">Delete</button> </a></td>";
				$movies_list.="</tr>";
			}

		}else{
			// echo "No movies to display";
		}

	}else{
		echo "Database query failed";
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>BLOCK BUSTER - Admin</title>
	<link rel="stylesheet" type="text/css" href="css/add-movie-tvseries.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>
<body>
	<div class="Wrapper">
		
	<?php require_once('inc/adminheader.php') ?>


	<main>
		<?php if(isset($_GET['is_the_owner'])){
			echo '<p class="error">Access Denied. Only the Owner Can Access Admins</p>';
		} ?>
		<?php if(isset($_GET['movie_modified_sucessfully'])){
			echo '<p class="cool">Successfully Modified the Movie</p>';
		} ?>
		<?php if(isset($_GET['movie_added_sucessfully'])){
			echo '<p class="cool">Successfully Uploded the Movie</p>';
		} ?>
		<?php if(isset($_GET['movie_found']) && $_GET['movie_found'] == 'false' ){
			echo '<p class="error">Cant Find a Movie with That Movie ID</p>';
		} ?>
		<?php if(isset($_GET['query_successful']) && $_GET['query_successful'] == 'false' ){
			echo '<p class="error">Database Query Failed</p>';
		} ?>
		<?php if(isset($_GET['set_movie_id']) && $_GET['set_movie_id'] == 'false' ){
			echo '<p class="error">Please Select or Type a Movie to View / Modify or Delete</p>';
		} ?>
		<?php if(isset($_GET['movie_deleted']) && $_GET['movie_deleted'] == 'true' ){
			echo '<p class="cool">Movie Deleted Successfully</p>';
		} ?>
		<?php if(isset($_GET['movie_deleted']) && $_GET['movie_deleted'] == 'false' ){
			echo '<p class="error">Movie Deleting Failed</p>';
		} ?>
		
		<h1>Movies
			<span>
				<a href="add-movie.php"><button class="addn"><i class="fas fa-plus"></i></button></a>  
				<a href="adminhome.php"><button class="refr"><i class="fas fa-redo-alt"></i></button></a>
			</span>
		</h1>

		<div class="Search">
			<form action="adminhome.php" method="get">
				<p>
					<input type="text" name="search" placeholder="Type Movie Name, Movie ID or Admin Id and Hit Enter" value="<?php echo $search ?>" required >
				</p>
			</form>
		</div>
		
		<table class="Movie-list">
				<tr>
					<th>Movie ID</th>
					<th>Admin ID<br>(Uploaded by)</th>
					<th>Movie Name</th>
					<th>Relese Date</th>
					<th>Uploaded Date</th>
					<th>Uploaded Time</th>
					<th>Modified Date-time</th>
					<th>Modified Admin</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>

				<?php echo $movies_list; ?>

				<style>
					table.Movie-list td a button.edt:hover{
						background-color: #2196F3;
					}
				</style>

		</table><!-- Movie-list -->

	</main>



	</div><!--Wrapper-->
</body>
</html>