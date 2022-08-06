<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php 

		if(!isset($_SESSION['user_id'])){
			header("Location:index.php?user_login=false");
		}else{

			$query = "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}'";
			$result = mysqli_query($connection, $query);

			if($result && mysqli_num_rows($result) == 1){
				$data = mysqli_fetch_assoc($result);
			}else{
				header('Location:index.php?user_found=false');
			}
		}


?>



<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER</title>
    <link rel="stylesheet" type="text/css" href="css/singlemovie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>

<body>

    <?php require_once('inc/hedersingle.php'); ?>



    <?php if(isset($_GET['review_found']) && $_GET['review_found'] == 'false' ){
			echo '<p class="error">Cant Find a Review with That Review ID</p>';
		} ?>
    <?php if(isset($_GET['query_successful']) && $_GET['query_successful'] == 'false' ){
			echo '<p class="error">Database Query Failed</p>';
		} ?>
    <?php if(isset($_GET['set_review_id']) && $_GET['set_review_id'] == 'false' ){
			echo '<p class="error">Please Select or Type a Review to Delete</p>';
		} ?>
    <?php if(isset($_GET['review_deleted']) && $_GET['review_deleted'] == 'true' ){
			echo '<p class="cool">Review Deleted Successfully</p>';
		} ?>
    <?php if(isset($_GET['review_deleted']) && $_GET['review_deleted'] == 'false' ){
			echo '<p class="error">Review Deleting Failed</p>';
		} ?>



    <div class="Upper">
        <h1>Hello <?php echo $data['name']; ?> ! <h3> - your profile</h3>
        </h1>

        <div class="balance">

        </div>





        <div class="Ratingbar">
            <h5><i class="fas fa-user-circle" style="padding-bottom: 4.5px;"></i> Member: </h5>

            <h4><i></i>Welcome to --BLOCK BUSTER--</h4>

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
            <img src="Post_images/Users/<?php echo $_SESSION['user_id']; ?>/<?php echo $data['p_photo']; ?>"
                alt="profile image">
        </div>
        <!--Cont-L-->

        <div class="Cont-R">


            <div class="Overview">
                <h3>Your detailes:</h3><br><br><br>
                <h2>Name: <?php echo $data['name']; ?></h2>
                <p>Email: <?php echo $data['email']; ?></p>
                <p>Last Login: <?php echo $data['last_login']; ?></p>


                <br>
                <h4>YOUR REVIWS ON M0VIES</h4><br><br>

                <?php


				$query_review = "SELECT * FROM reviews WHERE user_id = '{$_SESSION['user_id']}' AND is_deleted = 0";
				$result_review = mysqli_query($connection, $query_review);
				$num_reviews = mysqli_num_rows($result_review);

				?>


                <?php

			if($result_review && $num_reviews > 0){
				while ($data_review = mysqli_fetch_assoc($result_review)) {
				
					$query_movie = "SELECT * FROM movies WHERE movie_id = '{$data_review['post_id']}' LIMIT 1";
					$result_movie = mysqli_query($connection, $query_movie);

						if($result_movie){

							$data_movie = mysqli_fetch_assoc($result_movie);

					
					?>

                <div class="Single-review">
                    <div class="About">
                        <img src="Post_images/Movies/<?php echo $data_movie['movie_id']; ?>/<?php echo $data_movie['main_img']; ?>"
                            alt="Movie image">
                        <a href="singlemovie.php?movie_id=<?php echo $data_movie['movie_id'] ?>">
                            <h2><?php echo $data_movie['m_name']; ?></h2>
                        </a>
                        <h3><?php echo $data_review['r_name']; ?></h3>
                        <h5><?php

									$i = 0;
									while ($i < $data_review['ratings']) {
										echo'<i class="fas fa-star"></i>';
										$i++;
									}

								?></h5>
                        <h6><?php echo $data_review['u_date_time']; ?></h6>
                        <h4>By you</h4>
                    </div>
                    <!--About-->

                    <div class="balance">

                    </div>

                    <div class="Review">
                        <p><?php echo $data_review['description']; ?><br><br>
                            <a href="delete-user-review.php?review_id=<?php echo $data_review['review_id'] ?>"
                                onclick="return confirm('Are you sure you want to delete this review?');">
                                <button
                                    style="background-color: red;color:#fff; font-weight: bold;padding: 5px 10px;border: 1px solid red;border-radius: 15px;">DELETE
                                    THIS REVIEW
                                </button>
                            </a>
                        </p>

                    </div>
                    <!--Review-->
                </div>
                <!--Single-review-->

                <?php

						}else{
							header('Location:movielisting.php?movie_in_review_retrive=false');			
						}
				}


			}else if($num_reviews == 0){

				echo '<h5 style="color: #4280bf;">No Movie reviews to display</h5>';
			}


			?>






                <br>
                <h4>YOUR REVIEWS ON TV SERIES</h4><br><br>


                <?php


				$query_review = "SELECT * FROM tsrreviews WHERE user_id = '{$_SESSION['user_id']}' AND is_deleted = 0";
				$result_review = mysqli_query($connection, $query_review);
				$num_reviews = mysqli_num_rows($result_review);

				?>


                <?php

			if($result_review && $num_reviews > 0){
				while ($data_review = mysqli_fetch_assoc($result_review)) {
				
					$query_tvseries = "SELECT * FROM tvseries WHERE series_id = '{$data_review['post_id']}' LIMIT 1";
					$result_tvseries = mysqli_query($connection, $query_movie);

						if($result_tvseries){

							$data_tvseries = mysqli_fetch_assoc($result_tvseries);

					
					?>

                <div class="Single-review">
                    <div class="About">
                        <img src="Post_images/TVSeries/<?php echo $data_tvseries['series_id']; ?>/<?php echo $data_tvseries['main_img']; ?>"
                            alt="TVSeries image">
                        <a href="singletvseries.php?series_id=<?php echo $data_tvseries['series_id'] ?>">
                            <h2><?php echo $data_tvseries['s_name']; ?></h2>
                        </a>
                        <h3><?php echo $data_review['r_name']; ?></h3>
                        <h5><?php

									$i = 0;
									while ($i < $data_review['ratings']) {
										echo'<i class="fas fa-star"></i>';
										$i++;
									}

								?></h5>
                        <h6><?php echo $data_review['u_date_time']; ?></h6>
                        <h4>By you</h4>
                    </div>
                    <!--About-->

                    <div class="balance">

                    </div>

                    <div class="Review">
                        <p><?php echo $data_review['description']; ?><br><br>
                            <a href="delete-user-tsrreview.php?review_id=<?php echo $data_review['review_id'] ?>"
                                onclick="return confirm('Are you sure you want to delete this review?');">
                                <button
                                    style="background-color: red;color:#fff; font-weight: bold;padding: 5px 10px;border: 1px solid red;border-radius: 15px;">DELETE
                                    THIS REVIEW
                                </button>
                            </a>
                        </p>
                    </div>
                    <!--Review-->
                </div>
                <!--Single-review-->

                <?php

						}else{
							header('Location:tvserieslisting.php?tvseries_in_review_retrive=false');			
						}
				}


			}else if($num_reviews == 0){
				echo '<h5 style="color: #4280bf;">No TV Series reviews to display</h5>';
			}


			?>

            </div>
            <!--Overview-->




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