<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>


<?php

if (!isset($_SESSION['user_id'])) {
    header("Location:singletvseries-review.php?series_id={$_GET['series_id']}&user_login=false");
}

if (!isset($_GET['series_id'])) {
    header('Location:tvserieslisting.php?series_id=false');
} else {

    $series_id = mysqli_escape_string($connection, $_GET['series_id']);

    $query  = "SELECT * FROM tvseries WHERE series_id = '{$_GET['series_id']}' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
    } else {
        header('Location:tvserieslisting.php?retrive=false');
    }
}

?>

<?php

$errors = array();

$user_id = $_SESSION['user_id'];

$r_name      = '';
$ratings     = '';
$description = '';

if (isset($_POST['add_review'])) {

    $r_name      = $_POST['tittle'];
    $ratings     = $_POST['rating'];
    $description = $_POST['review'];
    $series_id   = $_POST['series_id'];

    $query  = "SELECT * FROM tvseries WHERE series_id = '{$_GET['series_id']}' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        header('Location:tvserieslisting.php?retrive=false');
    }

    //Checking required fields
    $req_fields = array('series_id', 'tittle', 'rating', 'review');
    $errors     = array_merge($errors, check_req_fields($req_fields));

    //Checking max lengths
    $max_len_fields = array('tittle' => 100, 'rating' => 2, 'review' => 1000);
    $errors         = array_merge($errors, check_max_len($max_len_fields));

    if (empty($errors)) {

        $r_name      = mysqlI_real_escape_string($connection, $_POST['tittle']);
        $ratings     = mysqlI_real_escape_string($connection, $_POST['rating']);
        $description = mysqlI_real_escape_string($connection, $_POST['review']);

        date_default_timezone_set("Asia/Kolkata");
        date_default_timezone_get();
        $u_date_time = date("Y-m-d G:i:sa");

        $query = "INSERT INTO tsrreviews(post_id, user_id, r_name, ratings, description, u_date_time, is_deleted) VALUES('{$series_id}', '{$user_id}', '{$r_name}', '{$ratings}', '{$description}', '{$u_date_time}', 0)";

        // echo $query;
        // die();

        $result = mysqli_query($connection, $query);

        if ($result) {

            header("Location:singletvseries-review.php?series_id={$_GET['series_id']}&review_added_sucessfully=true");
        } else {
            $errors[] = 'Database query failed';
        }

    } else {
        //header("Location:add-review.php?series_id={$_GET['series_id']}&fields_completed=false");
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
        <h1><?php echo $data['s_name']; ?> <h3>Year</h3>
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
while ($stars < $data['ratings']) {
    ?><i class="fas fa-star"></i><?php
$stars++;
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
                            MOVIES</a></li>
                </ul>
            </div>
            <!--Items-->


            <div class="Above">
                <h3>Write revier about:</h3>
                <h2><?php echo $data['s_name']; ?></h2>

            </div>
            <!--Above-->

            <div class="balance">

            </div>

            <div class="Add-review">
                <form method="post" action="add-tsrreview.php?series_id=<?php echo $_GET['series_id'] ?>">


                    <?php
if (!empty($errors)) {
    display_errors($errors);
}
?>


                    <input type="hidden" name="series_id" value="<?php echo $_GET['series_id']; ?>">
                    <!-- <input type="hidden" name="mov_id" value="<?php //echo $mov_id ?>"> -->

                    <p>
                        <label>Add a tittle to your review:</label>
                        <input type="text" name="tittle" placeholder="Tittle" <?php echo 'value="' . $r_name . '"'; ?>>
                    </p>
                    <div class="balance"></div>
                    <p>
                        <label>Give your rating:</label>
                        <input type="number" name="rating" placeholder="Ratings by number"
                            <?php echo 'value="' . $ratings . '"'; ?>>
                    </p>
                    <div class="balance"></div>
                    <p>
                        <label>Type your review:</label>
                        <textarea name="review" placeholder="Type review"><?php echo "{$description}"; ?></textarea>
                    </p>
                    <div class="balance"></div>
                    <p>
                        <button name="add_review">REVIEW</button>
                    </p>
                    <div class="balance"></div>
                </form>
            </div><!-- Add-review -->

            <div class="balance">

            </div>

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