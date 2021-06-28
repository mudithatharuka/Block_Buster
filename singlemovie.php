<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php 
		if(!isset($_GET['movie_id'])){
			header('Location:movielisting.php?movie_id=false');
		}else{
			$query = "SELECT * FROM movies WHERE movie_id = '{$_GET['movie_id']}' AND is_deleted = 0 LIMIT 1";
			$result = mysqli_query($connection, $query);

			if(mysqli_num_rows($result) == 1){

				$query = "SELECT * FROM movies WHERE movie_id = '{$_GET['movie_id']}' LIMIT 1";
				$result = mysqli_query($connection, $query);

				if($result){
					$data = mysqli_fetch_assoc($result);
				}else{
					header('Location:movielisting.php?retrive=false');
				}
			}else{
				header('Location:movielisting.php?is_deleted_or_not uploaded=true');
			}


		}

?>



<!DOCTYPE html>
<html>
<head>
	<title>BLOCK BUSTER> Your movie</title>
	<link rel="stylesheet" type="text/css" href="css/singlemovie.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>
<body>

	<?php require_once('inc/hedersingle.php'); ?>



	<div class="Upper">
		<h1><?php echo $data['m_name']; ?> <h3><?php echo $data['year']; ?></h3></h1>

		<div class="balance">
				
		</div>

		<button><i class="fas fa-heart"></i> ADD TO FAVOURITE</button>
		<button><i class="fas fa-share-alt"></i> SHARE</button>

		<div class="balance">
				
		</div>

		<div class="Ratingbar">
			<h5><i class="fas fa-star"></i>  <?php echo $data['ratings']; ?>/10 </h5>

			<h4>Rate this movie: 
			<?php 
				$stars = 0;
				while ($stars < $data['ratings']) {
					?><i class="fas fa-star"></i><?php
					$stars++;
				}
			?></h4>

		</div><!--Ratingbar-->
		<div class="balance">
				
		</div>
		<div class="empty">
			
		</div>
	</div><!--Upper-->



	<?php require_once('inc/hederfinal.php'); ?>


	<div class="Content">
		
		<div class="Cont-L">
			<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['main_img']; ?>" alt="movie image">	
		</div><!--Cont-L-->

		<div class="Cont-R">
			<div class="Items">
				<ul>
					<li><a href="<?php echo("singlemovie.php?movie_id={$_GET['movie_id']}") ?>">OVERVIEW</a></li>
					<li><a href="<?php echo("singlemovie-review.php?movie_id={$_GET['movie_id']}") ?>">REVIEWS</a></li>
					<li><a href="<?php echo("singlemovie-media.php?movie_id={$_GET['movie_id']}") ?>">MEDIA</a></li>
					<li><a href="<?php echo("singlemovie-relatedmovies.php?movie_id={$_GET['movie_id']}") ?>">RELATED MOVIES</a></li>
				</ul>
			</div><!--Items-->

			<div class="Overview">
				<h3>Overview of:</h3>
				<h2><?php echo $data['m_name']; ?></h2>
				<p><?php echo $data['m_descrip']; ?></p>


				<h4>OFFICIAL TRAILER</h4>
				<iframe width="100%" <?php echo $data['off_t_e_link']; ?>></iframe>

				<h4>FEW PHOTOS</h4>
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_1']; ?>" alt="movie image1">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_5']; ?>" alt="movie image1">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_8']; ?>" alt="movie image1">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_11']; ?>" alt="movie image1">
				
			</div><!--Overview-->

			<div class="Summery">
				<h5>Director:</h5>
				<h6><?php echo $data['m_director']; ?></h6>
				<h5>Writer:</h5>
				<h6><?php echo $data['m_writer']; ?></h6>
				<h5>Stars:</h5>
				<h6><?php echo $data['stars']; ?></h6>
				<h5>Genres:</h5>
				<h6><?php echo $data['genres']; ?></h6>
				<h5>Relese date:</h5>
				<h6><?php echo $data['relese_date']; ?></h6>
				<h5>Run time:</h5>
				<h6><?php echo $data['run_time']; ?>Mins</h6>
				<h5>IMDB rating:</h5>
				<h6><?php echo $data['ratings'].'/10'; ?></h6>
				
				<div class="Advertiesment1">
					<img src="img/LatestMv/slider4.jpg" align="Advertiesment1">
				</div><!--Advertiesment1-->

			</div><!--Summery-->


			<div class="balance">
				
			</div>

		</div><!--Cont-R-->
		
		<div class="balance">
				
		</div>
	</div><!--Content-->



	<?php require_once('inc/footer.php') ?>

	<?php require_once('inc/signup.php') ?>

	<?php require_once('inc/login.php') ?>

</body>
</html>
<?php mysqli_close($connection); ?>