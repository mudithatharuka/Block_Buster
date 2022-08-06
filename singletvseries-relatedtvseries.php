<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php 
		if(!isset($_GET['series_id'])){
			header('Location:tvserieslisting.php?series_id=false');
		}else{

			$query = "SELECT * FROM tvseries WHERE series_id = '{$_GET['series_id']}' LIMIT 1";
			$result = mysqli_query($connection, $query);

			if($result){
				$data = mysqli_fetch_assoc($result);
			}else{
				header('Location:tvserieslisting.php?retrive=false');
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

            <h4>Rate this TV series:
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


            <div class="Above">
                <h3>Related TV series of:</h3>
                <h2><?php echo $data['s_name']; ?></h2>

            </div>
            <!--Above-->

            <div class="balance">

            </div>



            <?php 

				$sql = "SELECT * FROM tvseries WHERE condi = 'Relesed' AND is_deleted = 0 AND series_id != '{$_GET['series_id']}' AND (main_category = '{$data['main_category']}' OR {$data['main_category']} = 'Yes') ORDER BY series_id DESC";
				$conseq = mysqli_query($connection, $sql);

				if(mysqli_num_rows($conseq) > 0){

					while($row = mysqli_fetch_assoc($conseq)){

					
				
				

			?>


            <a href="<?php echo("singletvseries.php?series_id={$row['series_id']}") ?>">

                <div class="Related-movies">
                    <img src="Post_images/TVSeries/<?php echo $row['series_id']; ?>/<?php echo $row['main_img']; ?>"
                        alt="series image">
                    <h4><?php echo $row['s_name']; ?></h4>
                    <h4><i class="fas fa-star"></i><?php echo $row['ratings']; ?>/10</h4>
                    <div class="descrip">
                        <p><?php echo $row['small_descrip']; ?></p>
                    </div>
                    <!--descrip-->
                    <p>Run time: <?php echo $row['run_time']; ?>' ...... Relese: 1 <?php echo $row['relese_date']; ?>
                    </p>
                    <h5>Director:</h5>
                    <h6><?php echo $row['s_director']; ?></h6>
                    <h5>Stars:</h5>
                    <h6><?php echo $row['stars']; ?></h6>
                    <div class="balance">

                    </div>
                </div>
                <!--Related-movies-->
            </a>

            <div class="balance">

            </div>



            <?php  

					}
				}else{
			?>

            <div class="Related-movies">
                <h4>No tv series related to <?php echo $data['s_name']; ?></h4>
            </div><!-- Related-movies -->

            <?php		
				}

			?>




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