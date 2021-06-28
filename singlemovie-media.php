<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php 
		if(!isset($_GET['movie_id'])){
			header('Location:movielisting.php?movie_id=false');
		}else{

			$query = "SELECT * FROM movies WHERE movie_id = '{$_GET['movie_id']}' LIMIT 1";
			$result = mysqli_query($connection, $query);

			if($result){
				$data = mysqli_fetch_assoc($result);
			}else{
				header('Location:movielisting.php?retrive=false');
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
		<h1><?php echo $data['m_name']; ?> <h3>Year</h3></h1>

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
			<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['main_img']; ?>" alt="im image">	
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

			
			<div class="Above">
				<h3>Photos & Videos of:</h3>
				<h2><?php echo $data['m_name']; ?></h2>
				
			</div><!--Above-->

			<div class="balance">
				
			</div>

			

			<div class="Videos">
				<h4>VIDEOS(4 videos)</h4>
				<iframe <?php echo $data['vid1_e_link']; ?>></iframe>
				<iframe <?php echo $data['vid2_e_link']; ?>></iframe>
				<iframe <?php echo $data['vid3_e_link']; ?>></iframe>
			</div><!--Videos-->

			<div class="Main-video">
				<iframe <?php echo $data['off_t_e_link']; ?>></iframe>
			</div><!--Main-video-->

			<div class="Photos">
				<h4>PHOTOS(12 photos)</h4>
				
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_1']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_2']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_3']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_4']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_5']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_6']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_7']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_8']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_9']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_10']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_11']; ?>" alt="movie image">
				<img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['im_12']; ?>" alt="movie image">
							

			</div><!--Photos-->



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