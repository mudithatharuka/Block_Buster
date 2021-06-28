<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php 
		if(!isset($_GET['cbr_id'])){
			header('Location:index.php?cbr_id=false');
		}else{

			$query = "SELECT * FROM celebrities WHERE cbr_id = '{$_GET['cbr_id']}' AND is_deleted = 0 LIMIT 1";
			$result = mysqli_query($connection, $query);

			if(mysqli_num_rows($result) == 1){

				$query = "SELECT * FROM celebrities WHERE cbr_id = '{$_GET['cbr_id']}' LIMIT 1";
				$result = mysqli_query($connection, $query);

				if($result){
					$data = mysqli_fetch_assoc($result);
				}else{
					header('Location:index.php?retrive=false');
				}
			}else{
				header('Location:index.php?is_deleted_or_not uploaded=true');
			}


		}

?>



<!DOCTYPE html>
<html>
<head>
	<title>BLOCK BUSTER> Celebrities</title>
	<link rel="stylesheet" type="text/css" href="css/singlemovie.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>
<body>

	<?php require_once('inc/hedersingle.php'); ?>



	<div class="Upper">
		<h1><?php echo $data['c_name']; ?> </h1>

		<div class="balance">
				
		</div>

		<button><i class="fas fa-heart"></i> ADD TO FAVOURITE</button>
		<button><i class="fas fa-share-alt"></i> SHARE</button>

		<div class="balance">
				
		</div>

		<div class="Ratingbar">
			<h5><i class="fas fa-star"></i>  <?php echo $data['ratings']; ?>/10 </h5>

			<h4>Level of the Celebrity: 
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
			<img src="Post_images/Celebrities/<?php echo $_GET['cbr_id']; ?>/<?php echo $data['main_img']; ?>" alt="celebrity image">	
		</div><!--Cont-L-->

		<div class="Cont-R">
			

			<div class="Overview">
				<h3>About the:</h3>
				<h2><?php echo $data['c_name']; ?></h2>
				<p><?php echo $data['c_descrip']; ?></p>



				<h4>FEW PHOTOS</h4>
				<img src="Post_images/Celebrities/<?php echo $_GET['cbr_id']; ?>/<?php echo $data['im_1']; ?>" alt="celebrity image1">
				<img src="Post_images/Celebrities/<?php echo $_GET['cbr_id']; ?>/<?php echo $data['im_2']; ?>" alt="celebrity image1">
				<img src="Post_images/Celebrities/<?php echo $_GET['cbr_id']; ?>/<?php echo $data['im_3']; ?>" alt="celebrity image1">
				<img src="Post_images/Celebrities/<?php echo $_GET['cbr_id']; ?>/<?php echo $data['im_4']; ?>" alt="celebrity image1">
				
			</div><!--Overview-->

			<div class="Summery">
				<h5>Age:</h5>
				<h6><?php echo $data['c_age']; ?> years old.</h6>
				<h5>Birthday:</h5>
				<h6><?php echo $data['birthday']; ?>.</h6>
				<h5>Years in industry:</h5>
				<h6>About <?php echo $data['years']; ?> years.</h6>
				<h5>Number of films:</h5>
				<h6>Around <?php echo $data['number_of_films']; ?> films.</h6>
				<h5>Number of tv series:</h5>
				<h6>Around <?php echo $data['number_of_tvseries']; ?> series.</h6>
				<h5>Audiance level:</h5>
				<h6>In <?php echo $data['ratings'].'/10'; ?> level.</h6>
				
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