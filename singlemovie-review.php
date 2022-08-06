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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>

<body>

    <?php require_once('inc/hedersingle.php'); ?>

    <?php if(isset($_GET['user_login']) && $_GET['user_login'] == 'false'){
		echo '<p class ="error">Please Log In First</p>';
	} ?>
    <?php if(isset($_GET['review_added_sucessfully']) && $_GET['review_added_sucessfully'] == 'true'){
		echo '<p class ="cool">Review Added Sucessfully.</p>';
	} ?>

    <div class="Upper">
        <h1><?php echo $data['m_name']; ?> <h3><?php echo $data['year']; ?></h3>
        </h1>

        <div class="balance">

        </div>

        <button><i class="fas fa-heart"></i> ADD TO FAVOURITE</button>
        <button><i class="fas fa-share-alt"></i> SHARE</button>

        <div class="balance">

        </div>

        <div class="Ratingbar">
            <h5><i class="fas fa-star"></i> <?php echo $data['ratings']; ?>/10 </h5>

            <h4>Rate this movie:
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
            <img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['main_img']; ?>"
                alt="movie image">
        </div>
        <!--Cont-L-->

        <div class="Cont-R">
            <div class="Items">
                <ul>
                    <li><a href="<?php echo("singlemovie.php?movie_id={$_GET['movie_id']}") ?>">OVERVIEW</a></li>
                    <li><a href="<?php echo("singlemovie-review.php?movie_id={$_GET['movie_id']}") ?>">REVIEWS</a></li>
                    <li><a href="<?php echo("singlemovie-media.php?movie_id={$_GET['movie_id']}") ?>">MEDIA</a></li>
                    <li><a href="<?php echo("singlemovie-relatedmovies.php?movie_id={$_GET['movie_id']}") ?>">RELATED
                            MOVIES</a></li>
                </ul>
            </div>
            <!--Items-->


            <div class="Above">
                <h3>Reveiws of:</h3>
                <h2><?php echo $data['m_name']; ?></h2>
                <a href="add-review.php?movie_id=<?php echo $_GET['movie_id'] ?>"><input type="submit"
                        name="write-review" value="REVIEW"></a>
            </div>
            <!--Above-->

            <div class="balance">

            </div>




            <?php


			$query_review = "SELECT * FROM reviews WHERE post_id = '{$_GET['movie_id']}' AND is_deleted = 0";
			$result_review = mysqli_query($connection, $query_review);
			$num_reviews = mysqli_num_rows($result_review);

			?>

            <div class="All-reviews">
                <h5>Found <?php echo $num_reviews; ?> reviews in total</h5>
            </div>
            <!--All-reviews-->

            <div class="balance">

            </div>

            <?php

			if($result_review && $num_reviews > 0){
				while ($data_review = mysqli_fetch_assoc($result_review)) {
				
					$query_user = "SELECT * FROM users WHERE user_id = '{$data_review['user_id']}' LIMIT 1";
					$result_user = mysqli_query($connection, $query_user);

						if($result_user){

							$data_user = mysqli_fetch_assoc($result_user);

					
					?>

            <div class="Single-review">
                <div class="About">
                    <img src="Post_images/Users/<?php echo $data_user['user_id']; ?>/<?php echo $data_user['p_photo']; ?>"
                        alt="Profile image">
                    <h3><?php echo $data_review['r_name']; ?></h3>
                    <h5><?php

									$i = 0;
									while ($i < $data_review['ratings']) {
										echo'<i class="fas fa-star"></i>';
										$i++;
									}

								?></h5>
                    <h6><?php echo $data_review['u_date_time']; ?></h6>
                    <h4><?php echo $data_user['name']; ?></h4>
                </div>
                <!--About-->

                <div class="balance">

                </div>

                <div class="Review">
                    <p><?php echo $data_review['description']; ?></p>
                </div>
                <!--Review-->
            </div>
            <!--Single-review-->

            <?php

						}else{
							header('Location:movielisting.php?user_in_review_retrive=false');			
						}
				}


			}else{
				if($num_reviews == 0){

				?>
            <!-- <div class="All-reviews">
						<h5>Found 0 reviews in total</h5>
					</div> -->
            <!--All-reviews-->

            <!-- <div class="balance">
						
					</div> -->
            <?php

				}else{
					header('Location:movielisting.php?review_retrive=false');

				}
			}


			?>








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