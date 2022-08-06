<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_GET['series_id'])) {
    header('Location:tvserieslisting.php?series_id=false');
} else {

    $query  = "SELECT * FROM tvseries WHERE series_id = '{$_GET['series_id']}' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
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

    <?php require_once 'inc/hedersingletvseries.php';?>



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
$stars    = 0;
$empstars = 0;
while ($stars < $data['ratings']) {
    ?><i class="fas fa-star"></i><?php
$stars++;
}
while ($empstars < 10 - $data['ratings']) {
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



    <?php require_once 'inc/hederfinal.php';?>


    <div class="Content">

        <div class="Cont-L">
            <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['main_img']; ?>"
                alt="series image">
        </div>
        <!--Cont-L-->

        <div class="Cont-R">
            <div class="Items">
                <ul>
                    <li><a href="<?php echo ("singletvseries.php?series_id={$_GET['series_id']}") ?>">OVERVIEW</a></li>
                    <li><a href="<?php echo ("singletvseries-review.php?series_id={$_GET['series_id']}") ?>">REVIEWS</a>
                    </li>
                    <li><a href="<?php echo ("singletvseries-media.php?series_id={$_GET['series_id']}") ?>">MEDIA</a>
                    </li>
                    <li><a href="<?php echo ("singletvseries-relatedtvseries.php?series_id={$_GET['series_id']}") ?>">RELATED
                            SERIES</a></li>
                </ul>
            </div>
            <!--Items-->


            <div class="Above">
                <h3>Photos & Videos of:</h3>
                <h2><?php echo $data['s_name']; ?></h2>

            </div>
            <!--Above-->

            <div class="balance">

            </div>



            <div class="Videos">
                <h4>VIDEOS(4 videos)</h4>
                <iframe <?php echo $data['vid1_e_link']; ?>></iframe>
                <iframe <?php echo $data['vid2_e_link']; ?>></iframe>
                <iframe <?php echo $data['vid3_e_link']; ?>></iframe>
            </div>
            <!--Videos-->

            <div class="Main-video">
                <iframe <?php echo $data['off_t_e_link']; ?>></iframe>
            </div>
            <!--Main-video-->

            <div class="Photos">
                <h4>PHOTOS(12 photos)</h4>
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_1']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_2']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_3']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_4']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_5']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_6']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_7']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_8']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_9']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_10']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_11']; ?>"
                    alt="series image">
                <img src="Post_images/TVSeries/<?php echo $_GET['series_id']; ?>/<?php echo $data['im_12']; ?>"
                    alt="series image">


            </div>
            <!--Photos-->



        </div>
        <!--Cont-R-->

        <div class="balance">

        </div>
    </div>
    <!--Content-->



    <?php require_once 'inc/footer.php'?>

    <?php require_once 'inc/signup.php'?>

    <?php require_once 'inc/login.php'?>

</body>

</html>
<?php mysqli_close($connection);?>