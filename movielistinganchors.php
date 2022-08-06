<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>

<?php

$query  = "SELECT * FROM movies_seq ORDER BY movie_id";
$try_id = mysqli_query($connection, $query);

if (mysqli_num_rows($try_id) > 0) {

    if (isset($_GET['popular'])) {
        $sql   = "SELECT * FROM movies WHERE is_deleted = 0 AND ratings > 5 ORDER BY movie_id DESC";
        $topic = 'MOST POPULAR MOVIES';
    } else if (isset($_GET['comming_soon'])) {
        $sql   = "SELECT * FROM movies WHERE is_deleted = 0 AND condi = 'Comming soon' ORDER BY movie_id DESC";
        $topic = 'COMMING SOON';
    } else if (isset($_GET['top_rated'])) {
        $sql   = "SELECT * FROM movies WHERE is_deleted = 0 AND ratings > 6 ORDER BY movie_id DESC";
        $topic = 'TOP RATED';
    } else if (isset($_GET['most_reviewed'])) {
        $sql   = "SELECT * FROM movies WHERE is_deleted = 0 AND ratings > 6 ORDER BY movie_id DESC";
        $topic = 'MOST REVIEWED';
    } else {
        $sql   = "SELECT * FROM movies WHERE is_deleted = 0 AND language ='Hollywood' ORDER BY movie_id DESC";
        $topic = 'MOVIELISTING';
    }

    $result      = mysqli_query($connection, $sql);
    $num_results = mysqli_num_rows($result);

    ?>



<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER> All Movies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/movielisting.css">
</head>

<body>

    <div class="Wrapper">

        <?php require_once 'inc/heder.php';?>


        <div class="Topic">
            <h1>~ <?php echo $topic; ?> ~</h1>
        </div>
        <!--Topic-->



        <?php require_once 'inc/hederfinal.php';?>


        <div class="Content">

            <div class="MovieList">




                <div class="Heading">
                    <h5>Found <?php echo "{$num_results}"; ?> movies in total</h5>
                    <h6> View model:</h6>
                    <h4><a href=""><i class="fas fa-list"></i></a></h4>
                    <h4><a href=""><i class="fas fa-th"></i></a></h4>
                </div>
                <!--Heading-->

                <div class="balance">

                </div>


                <?php

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            ?>





                <div class="List">

                    <a href="<?php echo ("singlemovie.php?movie_id={$row['movie_id']}") ?>">
                        <div class="movie">

                            <img
                                src="Post_images/Movies/<?php echo $row['movie_id']; ?>/<?php echo $row['main_img']; ?>">
                            <?php $b_color = define_b_color($row['main_category']);?>
                            <h6 style="background-color: <?php echo $b_color; ?>;"><?php echo $row['main_category']; ?>
                            </h6>
                            <h3><i class="fas fa-star"></i><?php echo $row['ratings'] . "/10"; ?></h3>
                            <h2><?php echo $row["m_name"]; ?></h2>

                        </div>
                    </a>

                </div>
                <!--List-->



                <?php

        }
    }
} else {

    ?>
                <div class="Heading">
                    <h5>Found 0 movies added to the site</h5>
                    <h6> View model:</h6>
                    <h4><a href=""><i class="fas fa-list"></i></a></h4>
                    <h4><a href=""><i class="fas fa-th"></i></a></h4>
                </div>
                <!--Heading-->

                <div class="balance">

                </div>
                <?php
}
?>



                <div class="balance">

                </div>

                <div class="Tailing">
                    <h5>See all movies</h5>
                    <h6> Page 1 of 10:</h6>
                    <h4><a href="">1</a> <a href=""> 2</a> <a href=""> 3</a> ... <a href=""> 10</a> <i
                            class="fas fa-caret-right"></i></h4>
                </div>
                <!--Tailing-->

            </div>
            <!--MovieList-->



            <div class="Sidebar">
                <div class="Side">

                    <div class="Sidesearch">
                        <h3>SEARCH FOR MOVIE</h3>

                        <div class="Searchpad">
                            <br>
                            <label>Movie name</label><br>
                            <input type="text" name="moviename" placeholder="  Enter keywords"><br>
                            <label>Genres & subgenres</label><br>
                            <select name="genres"><br>
                                <option> Your preference</option>
                                <option> Action</option>
                                <option> Comady</option>
                                <option> Sci-fi</option>
                                <option> Triller</option>
                                <option> Fantacy</option>
                            </select><br>
                            <label>Rating range</label><br>
                            <select name="ratingrange">
                                <option> Select rating range</option>
                                <option> More than 7</option>
                                <option> More than 7.5</option>
                                <option> More than 8</option>
                                <option> More than 8.5</option>
                            </select><br>
                            <label>Release year</label><br>
                            <div class="sp">
                                <select class="fromyear">
                                    <option> from</option>
                                    <option> 2016</option>
                                    <option> 2017</option>
                                    <option> 2018</option>
                                    <option> 2019</option>
                                    <option> 2020</option>
                                </select>
                                <select class="toyear">
                                    <option> to</option>
                                    <option> 2017</option>
                                    <option> 2018</option>
                                    <option> 2019</option>
                                    <option> 2020</option>
                                    <option> 2021</option>
                                </select><br>
                                <div class="find">
                                    <input type="submit" name="find" value="FIND"><br>
                                </div>
                            </div><br>
                        </div>
                        <!--Searchpad-->

                    </div>
                    <!--Sidesearch-->

                    <div class="Advertiesment1">
                        <img src="img/LatestMv/slider1.jpg" alt="Advertiesment1">
                    </div>
                    <!--Advertiesment1-->


                    <div class="S-Media-Sider">
                        <h3>FIND US ON</h3>
                        <br>
                        <div class="i"><i class="fab fa-facebook-f"></i></div>
                        <div class="i"><i class="fab fa-twitter"></i></div>
                        <div class="i"><i class="fab fa-google-plus-g"></i></div>
                        <div class="i"><i class="fab fa-youtube"></i></div>
                    </div>
                    <!--S-Media-Sider-->

                    <br><br>
                    <div class="balance">

                    </div>
                    <div class="Advertiesment2">
                        <img src="img/LatestMv/slider1.jpg" alt="Advertiesment2">
                    </div>
                    <!--Advertiesment2-->

                    <div class="Tweet">
                        <h3>TWEET TO US</h3>
                    </div>
                    <!--Tweet-->

                </div>
                <!--Side-->
            </div>
            <!--Sidebar-->

            <div class="balance">

            </div>

        </div>
        <!--Content-->


        <?php require_once 'inc/footer.php'?>

        <?php require_once 'inc/signup.php'?>

        <?php require_once 'inc/login.php'?>

    </div>
    <!--Wrapper-->

</body>

</html>
<?php mysqli_close($connection);?>