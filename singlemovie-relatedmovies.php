<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_GET['movie_id'])) {
    header('Location:movielisting.php?movie_id=false');
} else {

    $query  = "SELECT * FROM movies WHERE movie_id = '{$_GET['movie_id']}' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
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

    <?php require_once 'inc/hedersingle.php';?>



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
            <img src="Post_images/Movies/<?php echo $_GET['movie_id']; ?>/<?php echo $data['main_img']; ?>"
                alt="movie image">
        </div>
        <!--Cont-L-->

        <div class="Cont-R">
            <div class="Items">
                <ul>
                    <li><a href="<?php echo ("singlemovie.php?movie_id={$_GET['movie_id']}") ?>">OVERVIEW</a></li>
                    <li><a href="<?php echo ("singlemovie-review.php?movie_id={$_GET['movie_id']}") ?>">REVIEWS</a></li>
                    <li><a href="<?php echo ("singlemovie-media.php?movie_id={$_GET['movie_id']}") ?>">MEDIA</a></li>
                    <li><a href="<?php echo ("singlemovie-relatedmovies.php?movie_id={$_GET['movie_id']}") ?>">RELATED
                            MOVIES</a></li>
                </ul>
            </div>
            <!--Items-->


            <div class="Above">
                <h3>Related movies of:</h3>
                <h2><?php echo $data['m_name']; ?></h2>

            </div>
            <!--Above-->

            <div class="balance">

            </div>


            <?php

$sql    = "SELECT * FROM movies WHERE /*condi = 'Relesed' AND*/ (main_category = '{$data['main_category']}' OR {$data['main_category']} = 'Yes') AND movie_id != '{$_GET['movie_id']}' ORDER BY movie_id DESC";
$conseq = mysqli_query($connection, $sql);

if (mysqli_num_rows($conseq) > 0) {

    while ($row = mysqli_fetch_assoc($conseq)) {

        ?>

            <a href="<?php echo ("singlemovie.php?movie_id={$row['movie_id']}") ?>">
                <div class="Related-movies">
                    <img src="Post_images/Movies/<?php echo $row['movie_id']; ?>/<?php echo $row['main_img']; ?>"
                        alt="movie image">
                    <h4><?php echo $row['m_name']; ?></h4>
                    <h4><i class="fas fa-star"></i><?php echo $row['ratings']; ?>/10</h4>
                    <div class="descrip">
                        <p><?php echo $row['small_descrip']; ?></p>
                    </div>
                    <!--descrip-->
                    <p>Run time: <?php echo $row['run_time']; ?>' ...... Relese: <?php echo $row['relese_date']; ?></p>
                    <h5>Director:</h5>
                    <h6><?php echo $row['m_director']; ?></h6>
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
} else {
    ?>

            <div class="Related-movies">
                <h4>No movies related to <?php echo $data['m_name']; ?></h4>
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



    <?php require_once 'inc/footer.php'?>

    <?php require_once 'inc/signup.php'?>

    <?php require_once 'inc/login.php'?>

</body>

</html>
<?php mysqli_close($connection);?>