<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location:adminlogin.php?has_logged=false');
}
?>

<?php

$errors   = array();
$admin_id = $_SESSION['admin_id'];

$n_title     = '';
$relese_date = '';
$n_descrip   = '';
$category    = '';
$movie_name  = '';
$genres      = '';
$stars       = '';
$ratings     = '';

if (isset($_POST['add-latestnews'])) {

    $n_title     = $_POST['n_title'];
    $relese_date = $_POST['relese_date'];
    $n_descrip   = $_POST['n_descrip'];
    $category    = $_POST['category'];
    $movie_name  = $_POST['movie_name'];
    $genres      = $_POST['genres'];
    $stars       = $_POST['stars'];
    $ratings     = $_POST['ratings'];

    //Checking required fields
    $req_fields = array('n_title', 'relese_date', 'n_descrip', 'category', 'movie_name', 'genres', 'stars', 'ratings');
    $errors     = array_merge($errors, check_req_fields($req_fields));

    //Checkin required images
    $req_images = array('main_img', 'img1', 'img2', 'img3', 'img4');
    $errors     = array_merge($errors, check_req_images($req_images));

    //Checking max lengths
    $max_len_fields = array('n_title' => 500, 'relese_date' => 20, 'n_descrip' => 5000, 'category' => 20, 'movie_name' => 50, 'genres' => 100, 'stars' => 200, 'ratings' => 2);
    $errors         = array_merge($errors, check_max_len($max_len_fields));

    if (empty($errors)) {

        //No errors found. Sanitize the inputs
        $n_title     = mysqli_real_escape_string($connection, $_POST['n_title']);
        $relese_date = mysqli_real_escape_string($connection, $_POST['relese_date']);
        $n_descrip   = mysqli_real_escape_string($connection, $_POST['n_descrip']);
        $category    = mysqli_real_escape_string($connection, $_POST['category']);
        $movie_name  = mysqli_real_escape_string($connection, $_POST['movie_name']);
        $genres      = mysqli_real_escape_string($connection, $_POST['genres']);
        $stars       = mysqli_real_escape_string($connection, $_POST['stars']);
        $ratings     = mysqli_real_escape_string($connection, $_POST['ratings']);

        //Getting the ltn_id of the lastly added latestnews for make a directory for images
        $query = "SELECT * FROM latestnews_seq ORDER BY ltn_id DESC LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            if (mysqli_num_rows($result_set) == 1) {
                //Last ltn_id retrived
                $latestnews = mysqli_fetch_assoc($result_set);
                $id         = $latestnews['ltn_id'];
                $id++;
                if ($id > 1 && $id < 10) {
                    $ltn_id = "LTN00{$id}";
                } elseif ($id > 9 && $id < 100) {
                    $ltn_id = "LTN0{$id}";
                } elseif ($id > 99) {
                    $ltn_id = "LTN{$id}";
                }

            } else {
                $id     = 1;
                $ltn_id = "LTN00{$id}";
            }
        } else {
            $errors[] = 'Retriving last latestnews id database query faild';
        }

        //Maked a folder to store photos with ltn_id
        $curdir = getcwd();
        mkdir($curdir . "/Post_images/Latestnews/{$ltn_id}", 0777);

        $target_main = "Post_images/Latestnews/{$ltn_id}/" . basename($_FILES['main_img']['name']);
        $target1     = "Post_images/Latestnews/{$ltn_id}/" . basename($_FILES['img1']['name']);
        $target2     = "Post_images/Latestnews/{$ltn_id}/" . basename($_FILES['img2']['name']);
        $target3     = "Post_images/Latestnews/{$ltn_id}/" . basename($_FILES['img3']['name']);
        $target4     = "Post_images/Latestnews/{$ltn_id}/" . basename($_FILES['img4']['name']);

        $main_im = $_FILES['main_img']['name'];
        $im1     = $_FILES['img1']['name'];
        $im2     = $_FILES['img2']['name'];
        $im3     = $_FILES['img3']['name'];
        $im4     = $_FILES['img4']['name'];

        //Time zone is set to Asian time zone
        date_default_timezone_set("Asia/Kolkata");
        date_default_timezone_get();
        $u_date_time = date("Y-m-d G:i:sa");

        //Insert to table celebrities
        $query = "INSERT INTO latestnews(admin_id, n_title, relese_date, n_descrip, category, movie_name, genres, stars, ratings, main_img, im_1, im_2, im_3, im_4, u_date_time, is_deleted) VALUES ('{$admin_id}', '{$n_title}', '{$relese_date}', '{$n_descrip}', '{$category}', '{$movie_name}', '{$genres}', '{$stars}', '{$ratings}', '{$main_im}','{$im1}', '{$im2}', '{$im3}', '{$im4}', '{$u_date_time}',  0)";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            //Query successful

            if (move_uploaded_file($_FILES['main_img']['tmp_name'], $target_main) && move_uploaded_file($_FILES['img1']['tmp_name'], $target1) && move_uploaded_file($_FILES['img2']['tmp_name'], $target2) && move_uploaded_file($_FILES['img3']['tmp_name'], $target3) && move_uploaded_file($_FILES['img4']['tmp_name'], $target4)) {

                header('Location:latestnew.php?latestnew_added_sucessfully=true');

            } else {
                $errors[] = 'Adding failed. Uploded images did not saved';
            }

        } else {
            //Query unsucessful
            $errors[] = 'Database query failed';
        }

    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER > Admin</title>
    <link rel="stylesheet" type="text/css" href="css/add-movie-tvseries.css">
</head>

<body>

    <?php require_once 'inc/adminheader.php'?>

    <div class="Content">
        <h1>Add Latest News</h1>
        <a href="latestnew.php"><i class="fas fa-arrow-circle-left"></i></a>
        <div class="balance"></div>

        <?php
if (!empty($errors)) {
    display_errors($errors);
}
?>

        <form method="post" action="add-latestnews.php" enctype="multipart/form-data">

            <p>
                <label>News title:</label>
                <input type="text" name="n_title" placeholder=" Add title" <?php echo 'value="' . $n_title . '"'; ?>>
            </p>
            <div class="balance"></div>

            <p>
                <label>Main image:</label>
                <input type="file" id="im" name="main_img" accept="image/*">
            </p>

            <div class="balance"></div>

            <p class="c-descrip">
                <label>News Description:</label>
                <textarea name="n_descrip" placeholder=" Add a description"><?php echo "{$n_descrip}"; ?></textarea>
                <!-- <textarea class="article-input" id="article-input" type="text" rows="9" >{{article}}</textarea> -->
            </p>

            <div class="balance"></div>

            <label>Main category:</label>
            <input type="text" name="category" placeholder=" Add the main category"
                <?php echo 'value="' . $category . '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Movie name:</label>
                <input type="text" name="movie_name" placeholder=" Add movie name with"
                    <?php echo 'value="' . $movie_name . '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Genres:</label>
                <input type="text" name="genres" placeholder=" Add genres with <br>"
                    <?php echo 'value="' . $genres . '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Stars:</label>
                <input type="text" name="stars" placeholder=" Add stars with <br>"
                    <?php echo 'value="' . $stars . '"'; ?>>
            </p>


            <div class="balance"></div>
            <p>
                <label>Audiance ratings:</label>
                <input type="text" name="ratings" placeholder=" Add current audiance ratings"
                    <?php echo 'value="' . $ratings . '"'; ?>>
            </p>
            <div class="balance"></div>

            <p>
                <label>Relese date:</label>
                <input type="text" name="relese_date" placeholder=" Add the movie/series relese date"
                    <?php echo 'value="' . $relese_date . '"'; ?>>
            </p>
            <div class="balance"></div>


            <p>
                <label>Image 01:</label>
                <input type="file" id="im" name="img1" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 02:</label>
                <input type="file" id="im" name="img2" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 03:</label>
                <input type="file" id="im" name="img3" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 04:</label>
                <input type="file" id="im" name="img4" accept="image/*">
            </p>
            <div class="balance"></div>


            <button name="add-latestnews">ADD NEWS</button>

        </form>
    </div><!-- Content -->

    <style>
    .Content button:hover {
        background-color: #FF1100;
    }

    .Content a i:hover {
        color: #FF1100;
    }
    </style>

</body>

</html>
<?php mysqli_close($connection);?>