<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php 
		if(!isset($_GET['series_id'])){
			header('Location:tvserieslisting.php?series_id=false');
		}else{
			$query = "SELECT * FROM tvseries WHERE series_id = '{$_GET['series_id']}' AND is_deleted = 0 LIMIT 1";
			$result = mysqli_query($connection, $query);

			if(mysqli_num_rows($result) == 1){

				$query = "SELECT * FROM tvseries WHERE series_id = '{$_GET['series_id']}' LIMIT 1";
				$result = mysqli_query($connection, $query);

				if($result){
					$data = mysqli_fetch_assoc($result);
				}else{
					header('Location:tvserieslisting.php?retrive=false');
				}
			}else{
				header('Location:tvserieslisting.php?is_deleted_or_not uploaded=true');
			}


		}

?>


<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER> Your TV series</title>
    <link rel="stylesheet" type="text/css" href="css/singlemovie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>

<body>

    <?php require_once('inc/hedersingletvseries.php'); ?>



    <div class="Upper">
        <h1><?php echo $data['s_name']; ?> <h3><?php echo $data['year']; ?></h3>
        </h1>

        <div class="balance">

        </div>

        <button><i class="fas fa-heart"></i> ADD TO FAVOURITE</button>
        <button><i class="fas fa-share-alt"></i> SHARE</button>

        <div class="balance">

        </div>

        <div class="Ratingbar">
            <h5><i class="fas fa-star"></i> <?php echo $data['ratings']; ?>/10 </h5>

            <h4>Rate this TV Series:
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
            <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['main_img']; ?>"
                alt="series image">
        </div>
        <!--Cont-L-->

        <div class="Cont-R">
            <div class="Items">
                <ul>
                    <li><a href="<?php echo("singletvseries.php?series_id={$_GET['series_id']}") ?>">OVERVIEW</a></li>
                    <li><a href="<?php echo("singletvseries-review.php?series_id={$_GET['series_id']}") ?>">REVIEWS</a>
                    </li>
                    <li><a href="<?php echo("singletvseries-media.php?series_id={$_GET['series_id']}") ?>">MEDIA</a>
                    </li>
                    <li><a href="<?php echo("singletvseries-relatedtvseries.php?series_id={$_GET['series_id']}") ?>">RELATED
                            SERIES</a></li>
                </ul>
            </div>
            <!--Items-->

            <div class="Overview">
                <h3>Overview of:</h3>
                <h2><?php echo $data['s_name']; ?></h2>
                <p><?php echo $data['s_descrip']; ?></p>


                <h4>OFFICIAL TRAILER</h4>
                <iframe width="100%" <?php echo $data['off_t_e_link']; ?>></iframe>

                <h4>FEW PHOTOS</h4>
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_1']; ?>"
                    alt="series image1">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_5']; ?>"
                    alt="series image2">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_8']; ?>"
                    alt="series image3">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_11']; ?>"
                    alt="series image4">
            </div>
            <!--Overview-->

            <div class="Summery">
                <h5>Director:</h5>
                <h6><?php echo $data['s_director']; ?></h6>
                <h5>Writer:</h5>
                <h6><?php echo $data['s_writer']; ?></h6>
                <h5>Stars:</h5>
                <h6><?php echo $data['stars']; ?></h6>
                <h5>Genres:</h5>
                <h6><?php echo $data['genres']; ?></h6>
                <h5>Number of seasons:</h5>
                <h6><?php echo $data['seasons']; ?> Seasons</h6>
                <h5>Relese date:</h5>
                <h6><?php echo $data['relese_date']; ?></h6>
                <h5>Run time:</h5>
                <h6><?php echo $data['run_time']; ?>mins(1 episode)</h6>
                <h5>Rating:</h5>
                <h6><?php echo $data['ratings']; ?>/10</h6>

                <div class="Advertiesment1">
                    <img src="img/LatestMv/slider4.jpg" align="Advertiesment1">
                </div>
                <!--Advertiesment1-->

            </div>
            <!--Summery-->


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