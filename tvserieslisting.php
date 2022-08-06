<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>

<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER> TV Series</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/movielisting.css">
</head>

<body>

    <div class="Wrapper">

        <?php require_once 'inc/hedertvseries.php';?>


        <div class="Topic">
            <h1>TV SERIES LISTING - Grid View</h1>
        </div>
        <!--Topic-->


        <div class="Listtop">
            <ul>
                <li><a href="tvserieslisting.php?main_category=Action">Action</a></li>
                <li><a href="tvserieslisting.php?main_category=Animation">Animation</a></li>
                <li><a href="tvserieslisting.php?main_category=Sci-fi">Sci-fi</a></li>
                <li><a href="tvserieslisting.php?main_category=Comady">Comady</a></li>
                <li><a href="tvserieslisting.php?main_category=Thriller">Thriller</a></li>
                <li><a href="tvserieslisting.php?main_category=Horror">Horror</a></li>
            </ul>
        </div>
        <!--Listtop-->



        <?php require_once 'inc/hederfinal.php';?>


        <div class="Content">

            <div class="MovieList">



                <?php

$query  = "SELECT * FROM tvseries_seq ORDER BY series_id";
$try_id = mysqli_query($connection, $query);

if (mysqli_num_rows($try_id) > 0) {

    if (isset($_GET['main_category'])) {

        switch ($_GET['main_category']) {
            case 'Action':
                $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND main_category ='Action' ORDER BY series_id DESC";
                break;
            case 'Animation':
                $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND main_category ='Animation' ORDER BY series_id DESC";
                break;
            case 'Sci-fi':
                $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND main_category ='Sci-fi' ORDER BY series_id DESC";
                break;
            case 'Comady':
                $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND main_category ='Sci-fi' ORDER BY series_id DESC";
                break;
            case 'Horror':
                $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND main_category ='Horror' ORDER BY series_id DESC";
                break;
            case 'Thriller':
                $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND main_category ='Thriller' ORDER BY series_id DESC";
                break;
        }

    } else if (isset($_GET['find'])) {
        $moviename   = mysqli_real_escape_string($connection, $_GET['moviename']);
        $genres      = mysqli_real_escape_string($connection, $_GET['genres']);
        $ratingrange = mysqli_real_escape_string($connection, $_GET['ratingrange']);
        $fromyear    = mysqli_real_escape_string($connection, $_GET['fromyear']);
        $toyear      = mysqli_real_escape_string($connection, $_GET['toyear']);

        $sql = "SELECT * FROM tvseries WHERE (s_name LIKE '%{$moviename}%' OR main_category LIKE '%{$genres}%' OR year > '{$fromyear}' OR year < '{$toyear}') AND ratings > '{$ratingrange}' AND is_deleted = 0";
    } else if (isset($_GET['topsearch'])) {
        $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND language ='Hollywood' AND s_name = '{$_GET['name']}' ORDER BY series_id DESC";
    } else {
        $sql = "SELECT * FROM tvseries WHERE is_deleted = 0 AND condi ='Relesed' ORDER BY series_id DESC";
    }

    $result      = mysqli_query($connection, $sql);
    $num_results = mysqli_num_rows($result);

    ?>

                <div class="Heading">
                    <h5>Found <?php echo "{$num_results}"; ?> tv series in total</h5>
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
                    <a href="<?php echo ("singletvseries.php?series_id={$row['series_id']}") ?>">
                        <div class="movie">
                            <img
                                src="Post_images/TVSeries/<?php echo $row['series_id']; ?>/<?php echo $row['main_img']; ?>">
                            <?php $b_color = define_b_color($row['main_category']);?>
                            <h6 style="background-color: <?php echo $b_color; ?>;"><?php echo $row['main_category']; ?>
                            </h6>
                            <h3><i class="fas fa-star"></i><?php echo $row['ratings'] . "/10"; ?></h3>
                            <h2><?php echo $row["s_name"]; ?></h2>
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
                    <h5>Found 0 tv series in total</h5>
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
                    <h5>See all tv series</h5>
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
                        <h3>SEARCH FOR TV SERIES</h3>

                        <form action="tvserieslisting.php" method="get">

                            <div class="Searchpad">
                                <br>
                                <label>Series name</label><br>
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
                                    <option value="1"> Select rating range</option>
                                    <option value="7"> More than 7</option>
                                    <option value="7.5"> More than 7.5</option>
                                    <option value="8"> More than 8</option>
                                    <option value="8.5"> More than 8.5</option>
                                </select><br>
                                <label>Release year</label><br>
                                <div class="sp">
                                    <select name="fromyear">
                                        <option value="2000"> from</option>
                                        <option value="2016"> 2016</option>
                                        <option value="2017"> 2017</option>
                                        <option value="2018"> 2018</option>
                                        <option value="2019"> 2019</option>
                                        <option value="2020"> 2020</option>
                                    </select>
                                    <select name="toyear">
                                        <option value="2022"> to</option>
                                        <option value="2017"> 2017</option>
                                        <option value="2018"> 2018</option>
                                        <option value="2019"> 2019</option>
                                        <option value="2020"> 2020</option>
                                        <option value="2021"> 2021</option>
                                    </select><br>
                                    <div class="find">
                                        <input type="submit" name="find" value="FIND"><br>
                                    </div>
                                </div><br>
                            </div>
                            <!--Searchpad-->

                        </form>

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