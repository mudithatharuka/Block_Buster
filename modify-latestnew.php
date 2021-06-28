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
	$admin_id = $_SESSION['admin_id'];
	$lat_id = '';

	$n_title = '';
	$relese_date = '';
	$n_descrip = '';
	$category = '';
	$movie_name = '';
	$genres = '';
	$stars = '';
	$ratings = '';


	if(isset($_GET['ltn_id'])){
		$lat_id = mysqli_real_escape_string($connection, $_GET['ltn_id']);
		$query = "SELECT * FROM latestnews WHERE ltn_id = '{$lat_id}' LIMIT 1";

		// echo $query;
		// die();

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//Latest News found
				$result = mysqli_fetch_assoc($result_set);
					
					$n_title = $result['n_title'];
					$relese_date = $result['relese_date'];
					$n_descrip = $result['n_descrip'];
					$category = $result['category'];
					$movie_name = $result['movie_name'];
					$genres = $result['genres'];
					$stars = $result['stars'];
					$ratings = $result['ratings'];



			}else{
				//Latest News not found
				header('Location:latestnew.php?latestnew_found=false');
			}
		}else{
			//Queru unsuccessful
			header('Location:latestnew.php?query_successful=false');
		}
	}else{
		// header('Location:latestnew.php?set_celebrity_id=false');
	}
	 
	

	if(isset($_POST['save'])){

		$lat_id = $_POST['lat_id'];
		$n_title = $_POST['n_title'];
		$relese_date = $_POST['relese_date'];
		$n_descrip = $_POST['n_descrip'];
		$category = $_POST['category'];
		$movie_name = $_POST['movie_name'];
		$genres = $_POST['genres'];
		$stars = $_POST['stars'];
		$ratings = $_POST['ratings'];




		//Checking required fields
		$req_fields =array('lat_id','n_title','relese_date','n_descrip','category','movie_name', 'genres','stars','ratings');
		$errors = array_merge($errors, check_req_fields($req_fields));

		//Checkin required images
		$req_images =array('main_img','img1','img2','img3','img4');
		$errors = array_merge($errors, check_req_images($req_images));

		//Checking max lengths
	 	$max_len_fields = array('n_title' => 500,'relese_date' => 20,'n_descrip' => 5000,'category' => 20,'movie_name' => 50,'genres' => 100,'stars' => 200,'ratings' => 2);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		if(empty($errors)){

			//No errors found. Sanitize the inputs
			$n_title = mysqli_real_escape_string($connection, $_POST['n_title']);
			$relese_date = mysqli_real_escape_string($connection, $_POST['relese_date']);
			$n_descrip = mysqli_real_escape_string($connection, $_POST['n_descrip']);
			$category = mysqli_real_escape_string($connection, $_POST['category']);
			$movie_name = mysqli_real_escape_string($connection, $_POST['movie_name']);
			$genres = mysqli_real_escape_string($connection, $_POST['genres']);
			$stars = mysqli_real_escape_string($connection, $_POST['stars']);
			$ratings = mysqli_real_escape_string($connection, $_POST['ratings']);

			$curdir = getcwd();

			$target_main = "Post_images/Latestnews/{$lat_id}/".basename($_FILES['main_img']['name']);
			$target1 = "Post_images/Latestnews/{$lat_id}/".basename($_FILES['img1']['name']);
			$target2 = "Post_images/Latestnews/{$lat_id}/".basename($_FILES['img2']['name']);
			$target3 = "Post_images/Latestnews/{$lat_id}/".basename($_FILES['img3']['name']);
			$target4 = "Post_images/Latestnews/{$lat_id}/".basename($_FILES['img4']['name']);
			

			$main_im = $_FILES['main_img']['name'];
			$im1 = $_FILES['img1']['name'];
			$im2 = $_FILES['img2']['name'];
			$im3 = $_FILES['img3']['name'];
			$im4 = $_FILES['img4']['name'];
			

			//Time zone is set to Asian time zone
			date_default_timezone_set("Asia/Kolkata");
			date_default_timezone_get();
			$l_u_date_time = date("Y-m-d G:i:sa");
			

			//Insert to table latestnews
			$query = "UPDATE latestnews SET n_title = '{$n_title}', main_img = '{$main_im}', relese_date = '{$relese_date}', n_descrip = '{$n_descrip}', category = '{$category}', movie_name = '{$movie_name}', ratings = '{$ratings}', genres = '{$genres}', stars = '{$stars}', im_1 = '{$im1}', im_2 = '{$im2}', im_3 = '{$im3}', im_4 = '{$im4}', l_u_date_time = '{$l_u_date_time}', l_u_admin = '{$admin_id}' WHERE ltn_id = '{$lat_id}' LIMIT 1";

			// echo $query;
			// die();

			$result_set = mysqli_query($connection, $query);

			if($result_set){
				//Query successful

				if(move_uploaded_file($_FILES['main_img']['tmp_name'], $target_main) && move_uploaded_file($_FILES['img1']['tmp_name'], $target1) && move_uploaded_file($_FILES['img2']['tmp_name'], $target2) && move_uploaded_file($_FILES['img3']['tmp_name'], $target3) && move_uploaded_file($_FILES['img4']['tmp_name'], $target4)){

					header('Location:latestnew.php?latestnew_modified_sucessfully=true');

				}else{
					$errors[] = 'Modification failed. Uploded immages did not saved';
				}

			}else{
				//Query unsucessful
				$errors[] = 'Database query failed';
				// echo mysqli_error($connection);
			}

		}

	}



?>

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
		<h1>Modify / View Latest News</h1>
		<a href="latestnew.php"> <-Back to list</a>
		<div class="balance"></div>

		<?php
			if(!empty($errors)){
				display_errors($errors);
			}
		?>

		<form method="post" action="modify-latestnew.php" enctype="multipart/form-data">

			<input type="hidden" name="lat_id" value="<?php echo $lat_id ?>">
			
			<p>
				<label>News title:</label>
				<input type="text" name="n_title" placeholder=" Add title" <?php echo 'value="' .$n_title. '"'; ?>>
			</p>
			<div class="balance"></div>

			<p>
				<label>Main image:</label>
				<input type="file" id="im" name="main_img" accept="image/*" >
			</p>

			<div class="balance"></div>			
			
			<p class="c-descrip">
				<label>News Description:</label>
				<textarea name="n_descrip" placeholder=" Add a description"><?php echo "{$n_descrip}"; ?></textarea>
				<!-- <textarea class="article-input" id="article-input" type="text" rows="9" >{{article}}</textarea> --> 
			</p>

			<div class="balance"></div>
			
				<label>Main category:</label>
				<input type="text" name="category" placeholder=" Add the main category" <?php echo 'value="' .$category. '"'; ?>>
			</p>

			<div class="balance"></div>
			
			<p>
				<label>Movie name:</label>
				<input type="text" name="movie_name" placeholder=" Add movie name with" <?php echo 'value="' .$movie_name. '"'; ?>>
			</p>
			
			<div class="balance"></div>
			
			<p>
				<label>Genres:</label>
				<input type="text" name="genres" placeholder=" Add genres with <br>" <?php echo 'value="' .$genres. '"'; ?>>
			</p>

			<div class="balance"></div>
			
			<p>
				<label>Stars:</label>
				<input type="text" name="stars" placeholder=" Add stars with <br>" <?php echo 'value="' .$stars. '"'; ?>>
			</p>

			
			<div class="balance"></div>
			<p>
				<label>Audiance ratings:</label>
				<input type="text" name="ratings" placeholder=" Add current audiance ratings" <?php echo 'value="' .$ratings. '"'; ?>>
			</p>
			<div class="balance"></div>

			<p>
				<label>Relese date:</label>
				<input type="text" name="relese_date" placeholder=" Add the movie/series relese date" <?php echo 'value="' .$relese_date. '"'; ?>>
			</p>
			<div class="balance"></div>
			

			<p>
				<label>Image 01:</label>
				<input type="file" id="im" name="img1" accept="image/*" >
			</p>
			<div class="balance"></div>
			<p>
				<label>Image 02:</label>
				<input type="file" id="im" name="img2" accept="image/*" >
			</p>
			<div class="balance"></div>
			<p>
				<label>Image 03:</label>
				<input type="file" id="im" name="img3" accept="image/*" >
			</p>
			<div class="balance"></div>
			<p>
				<label>Image 04:</label>
				<input type="file" id="im" name="img4" accept="image/*" >
			</p>
			<div class="balance"></div>


			<button name="save">SAVE CHANGES</button>

		</form>
	</div><!-- Content -->

</body>
</html>
<?php mysqli_close($connection); ?>