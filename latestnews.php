<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php 
		if(!isset($_GET['ltn_id'])){
			header('Location:index.php?ltn_id=false');
		}else{

			$query = "SELECT * FROM latestnews WHERE ltn_id = '{$_GET['ltn_id']}' AND is_deleted = 0 LIMIT 1";
			$result = mysqli_query($connection, $query);

			if(mysqli_num_rows($result) == 1){

				$query = "SELECT * FROM latestnews WHERE ltn_id = '{$_GET['ltn_id']}' LIMIT 1";
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
    <title>BLOCK BUSTER> Latestnews</title>
    <link rel="stylesheet" type="text/css" href="css/singlemovie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>

<body>

    <?php require_once('inc/hedersingle.php'); ?>



    <div class="Upper">
        <h1><?php echo ucwords($data['n_title']); ?> </h1>

        <div class="balance">

        </div>

        <button><i class="fas fa-heart"></i> ADD TO FAVOURITE</button>
        <button><i class="fas fa-share-alt"></i> SHARE</button>

        <div class="balance">

        </div>

        <div class="Ratingbar">
            <h5><i class="fas fa-star"></i> <?php echo($data['ratings']); ?>/10 </h5>

            <h4>Level of the watchers responce:
                <?php 
				$stars = 0;
				$empstars = 0;
				while ($stars < $data['ratings']) {
					?><i class="fas fa-star"></i><?php
					$stars++;
				}
				while($empstars < 10 - $data['ratings']){
					?><i class="fas fa-star" style="color: rgba(105, 105, 105, 0.6);"></i><?php
					$empstars++;
				}
			?></h4>

        </div>
        <!--Ratingbar-->
        <div class="balance">

        </div>
        <div class="empty">

        </div>
    </div>
    <!--Upper-->



    <?php require_once('inc/hederfinal.php'); ?>


    <div class="Content">

        <div class="Cont-L">
            <img src="Post_images/Latestnews/<?php echo $_GET['ltn_id']; ?>/<?php echo $data['main_img']; ?>"
                alt="latestnews image">
        </div>
        <!--Cont-L-->

        <div class="Cont-R">


            <div class="Overview">
                <h2><?php echo($data['movie_name']); ?></h2>
                <p><?php echo($data['n_descrip']); ?></p>



                <h4>FEW PHOTOS</h4>
                <img src="Post_images/Latestnews/<?php echo $_GET['ltn_id']; ?>/<?php echo $data['im_1']; ?>"
                    alt="latestnews image1">
                <img src="Post_images/Latestnews/<?php echo $_GET['ltn_id']; ?>/<?php echo $data['im_2']; ?>"
                    alt="latestnews image1">
                <img src="Post_images/Latestnews/<?php echo $_GET['ltn_id']; ?>/<?php echo $data['im_3']; ?>"
                    alt="latestnews image1">
                <img src="Post_images/Latestnews/<?php echo $_GET['ltn_id']; ?>/<?php echo $data['im_4']; ?>"
                    alt="latestnews image1">

            </div>
            <!--Overview-->

            <div class="Summery">
                <h5>Main category:</h5>
                <h6><?php echo($data['category']); ?>.</h6>
                <h5>Generes:</h5>
                <h6><?php echo($data['genres']); ?></h6>
                <h5>Stars:</h5>
                <h6><?php echo($data['stars']); ?></h6>
                <h5>Relese date:</h5>
                <h6><?php echo($data['relese_date']); ?></h6>

                <div class="Advertiesment1">
                    <img src="img/LatestMv/slider4.jpg" align="Advertiesment1">
                </div>
                <!--Advertiesment1 -->

            </div>
            <!--Summery -->


            <div class="balance">

            </div>

        </div>
        <!--Cont-R-->

        <div class="balance">

        </div>
    </div>
    <!--Content-->



    <?php require_once('inc/footer.php') ?>

    <?php require_once('inc/signup.php') ?>

    <?php require_once('inc/login.php') ?>

</body>

</html>
<?php mysqli_close($connection); ?>