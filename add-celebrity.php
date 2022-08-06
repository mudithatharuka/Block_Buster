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

$c_name             = '';
$c_age              = '';
$birthday           = '';
$c_descrip          = '';
$years              = '';
$ratings            = '';
$number_of_films    = '';
$number_of_tvseries = '';

if (isset($_POST['add-celebrity'])) {

    $c_name             = $_POST['c_name'];
    $c_age              = $_POST['c_age'];
    $birthday           = $_POST['birthday'];
    $c_descrip          = $_POST['c_descrip'];
    $years              = $_POST['years'];
    $ratings            = $_POST['ratings'];
    $number_of_films    = $_POST['number_of_films'];
    $number_of_tvseries = $_POST['number_of_tvseries'];

    //Checking required fields
    $req_fields = array('c_name', 'c_age', 'birthday', 'c_descrip', 'years', 'ratings', 'number_of_films', 'number_of_tvseries');
    $errors     = array_merge($errors, check_req_fields($req_fields));

    //Checkin required images
    $req_images = array('main_img', 'img1', 'img2', 'img3', 'img4');
    $errors     = array_merge($errors, check_req_images($req_images));

    //Checking max lengths
    $max_len_fields = array('c_name' => 100, 'c_age' => 2, 'birthday' => 20, 'c_descrip' => 5000, 'years' => 3, 'ratings' => 2, 'number_of_films' => 5, 'number_of_tvseries' => 5);
    $errors         = array_merge($errors, check_max_len($max_len_fields));

    if (empty($errors)) {

        //No errors found. Sanitize the inputs
        $c_name             = mysqli_real_escape_string($connection, $_POST['c_name']);
        $c_age              = mysqli_real_escape_string($connection, $_POST['c_age']);
        $birthday           = mysqli_real_escape_string($connection, $_POST['birthday']);
        $c_descrip          = mysqli_real_escape_string($connection, $_POST['c_descrip']);
        $years              = mysqli_real_escape_string($connection, $_POST['years']);
        $ratings            = mysqli_real_escape_string($connection, $_POST['ratings']);
        $number_of_films    = mysqli_real_escape_string($connection, $_POST['number_of_films']);
        $number_of_tvseries = mysqli_real_escape_string($connection, $_POST['number_of_tvseries']);

        //Getting the cbr_id of the lastly added celebrity for make a directory for images
        $query = "SELECT * FROM celebrities_seq ORDER BY cbr_id DESC LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            if (mysqli_num_rows($result_set) == 1) {
                //Last cbr_id retrived
                $celebrity = mysqli_fetch_assoc($result_set);
                $id        = $celebrity['cbr_id'];
                $id++;
                if ($id > 1 && $id < 10) {
                    $cbr_id = "CBR00{$id}";
                } elseif ($id > 9 && $id < 100) {
                    $cbr_id = "CBR0{$id}";
                } elseif ($id > 99) {
                    $cbr_id = "CBR{$id}";
                }

            } else {
                $id     = 1;
                $cbr_id = "CBR00{$id}";
            }
        } else {
            $errors[] = 'Retriving last celebrity id database query faild';
        }

        //Maked a folder to store photos with cbr_id
        $curdir = getcwd();
        mkdir($curdir . "/Post_images/Celebrities/{$cbr_id}", 0777);

        $target_main = "Post_images/Celebrities/{$cbr_id}/" . basename($_FILES['main_img']['name']);
        $target1     = "Post_images/Celebrities/{$cbr_id}/" . basename($_FILES['img1']['name']);
        $target2     = "Post_images/Celebrities/{$cbr_id}/" . basename($_FILES['img2']['name']);
        $target3     = "Post_images/Celebrities/{$cbr_id}/" . basename($_FILES['img3']['name']);
        $target4     = "Post_images/Celebrities/{$cbr_id}/" . basename($_FILES['img4']['name']);

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
        $query = "INSERT INTO celebrities(admin_id, c_name, c_age, birthday, c_descrip, years, ratings, number_of_films,number_of_tvseries, main_img, im_1, im_2, im_3, im_4, u_date_time, is_deleted) VALUES ('{$admin_id}', '{$c_name}', '{$c_age}', '{$birthday}', '{$c_descrip}', '{$years}', '{$ratings}', '{$number_of_films}','{$number_of_tvseries}', '{$main_im}','{$im1}', '{$im2}', '{$im3}', '{$im4}', '{$u_date_time}',  0)";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            //Query successful

            if (move_uploaded_file($_FILES['main_img']['tmp_name'], $target_main) && move_uploaded_file($_FILES['img1']['tmp_name'], $target1) && move_uploaded_file($_FILES['img2']['tmp_name'], $target2) && move_uploaded_file($_FILES['img3']['tmp_name'], $target3) && move_uploaded_file($_FILES['img4']['tmp_name'], $target4)) {

                header('Location:celebrity.php?celebrity_added_sucessfully=true');

            } else {
                $errors[] = 'Adding failed. Uploded immages did not saved';
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
        <h1>Add Celebrities</h1>
        <a href="celebrity.php"><i class="fas fa-arrow-circle-left"></i></a>
        <div class="balance"></div>

        <?php
if (!empty($errors)) {
    display_errors($errors);
}
?>

        <form method="post" action="add-celebrity.php" enctype="multipart/form-data">

            <p>
                <label>Celebrity Name:</label>
                <input type="text" name="c_name" placeholder=" Add name" <?php echo 'value="' . $c_name . '"'; ?>>
            </p>
            <div class="balance"></div>

            <p>
                <label>Main image:</label>
                <input type="file" id="im" name="main_img" accept="image/*">
            </p>

            <div class="balance"></div>
            <p>
                <label>Birthday:</label>
                <input name="birthday" placeholder=" Add birthday" <?php echo 'value="' . $birthday . '"'; ?>>
            </p>

            <div class="balance"></div>
            <p>
                <label>Celebrity age:</label>
                <input type="number" name="c_age" placeholder=" Add age" <?php echo 'value="' . $c_age . '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
            <p class="c-descrip">
                <label>Celebrity Description:</label>
                <textarea name="c_descrip" placeholder=" Add a description"><?php echo "{$c_descrip}"; ?></textarea>
                <!-- <textarea class="article-input" id="article-input" type="text" rows="9" >{{article}}</textarea> -->
            </p>

            <div class="balance"></div>

            <label>Celebrity in industry:</label>
            <input type="text" name="years" placeholder=" Add his years of this industry"
                <?php echo 'value="' . $years . '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>How much audiance he has:</label>
                <input type="number" name="ratings" placeholder=" Add ratings/10"
                    <?php echo 'value="' . $ratings . '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Number of films:</label>
                <input type="number" name="number_of_films" placeholder=" Add number of films participated"
                    <?php echo 'value="' . $number_of_films . '"'; ?>>
            </p>


            <div class="balance"></div>
            <p>
                <label>Number of tvseries:</label>
                <input type="number" name="number_of_tvseries" placeholder=" Add number of tvseries participated"
                    <?php echo 'value="' . $number_of_tvseries . '"'; ?>>
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


            <button name="add-celebrity">ADD CELEBRITY</button>

        </form>
    </div><!-- Content -->

    <style>
    .Content button:hover {
        background-color: #d6762e;
    }

    .Content a i:hover {
        color: #d6762e;
    }
    </style>

</body>

</html>
<?php mysqli_close($connection);?>