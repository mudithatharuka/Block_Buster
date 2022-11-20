<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>


<!-- Sign Up Process is Here -->
<?php

$errors      = array();
$emailerrors = array();

$name          = '';
$email         = '';
$password      = '';
$profile_photo = '';

if (isset($_POST['sign'])) {

    $name  = $_POST['name'];
    $email = $_POST['email'];

    //Checking required fields
    $req_fields = array('name', 'email', 'password');
    $errors     = array_merge($errors, check_req_fields($req_fields));

    //Checkin required images
    $req_images = array('profile_photo');
    $errors     = array_merge($errors, check_req_images($req_images));

    //Checking max length
    $max_len_fields = array('name' => 50, 'email' => 100, 'password' => 40);
    $errors         = array_merge($errors, check_max_len($max_len_fields));

    //Checking email address
    if (!is_email($_POST['email'])) {
        $errors[] = 'Email address is invalid';
    }

    //Checking if email address is already exist
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $query = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            $emailerrors[] = 'Email address already exist';
        }
    }

    if (empty($errors) && empty($emailerrors)) {
        //No errors found.. Adding to tha database
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        //email is already sanitized
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $hashed_password = sha1($password);

        //Getting the user_id of the lastly added user for make a directory for images
        $query = "SELECT * FROM users_seq ORDER BY user_id DESC LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            if (mysqli_num_rows($result_set) == 1) {
                //Last user_id retrived
                $user = mysqli_fetch_assoc($result_set);
                $id   = $user['user_id'];
                $id++;
                if ($id > 1 && $id < 10) {
                    $user_id = "USR_00{$id}";
                } elseif ($id > 9 && $id < 100) {
                    $user_id = "USR_0{$id}";
                } elseif ($id > 99) {
                    $user_id = "USR_{$id}";
                }

            } else {
                $id      = 1;
                $user_id = "USR_00{$id}";
            }
        } else {
            $errors[] = 'Retriving last user id database query faild';
        }

        $curdir = getcwd();
        mkdir($curdir . "/Post_images/Users/{$user_id}", 0777);

        $target = "Post_images/Users/{$user_id}/" . basename($_FILES['profile_photo']['name']);

        $profile_photo = $_FILES['profile_photo']['name'];

        $query = "INSERT INTO  users(name,email,password,p_photo,is_deleted) VALUES ('{$name}','{$email}','{$hashed_password}','{$profile_photo}',0)";

        $result = mysqli_query($connection, $query);

        if ($result) {
            //Query successful

            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target)) {

                header('Location:index.php?user_added_sucessfully=true');

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
<!-- Sign Up Process Over -->

<!-- Login Process is Here -->


<?php

$errors_in_login = array();

// $email ='';

if (isset($_POST['log'])) {

    $email = $_POST['email'];

    //Checking if the email and password is entered
    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1) {
        $errors_in_login[] = 'Email is missing or invalid';
    }
    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
        $errors_in_login[] = 'Password is missing or invalid';
    }

    //Checking if there are errors in the form
    if (empty($errors_in_login)) {

        $email           = mysqli_real_escape_string($connection, $_POST['email']);
        $password        = mysqli_real_escape_string($connection, $_POST['password']);
        $hashed_password = sha1($password);

        //Database query
        $query = "SELECT * FROM users WHERE email ='{$email}' AND password ='{$hashed_password}' LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            if (mysqli_num_rows($result_set) == 1) {
                //Valid user found
                $user                = mysqli_fetch_assoc($result_set);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name']    = $user['name'];
                //Update last login
                $query      = "UPDATE users SET last_login = NOW() WHERE user_id = '{$_SESSION['user_id']}' LIMIT 1";
                $result_set = mysqli_query($connection, $query);

                if (!$result_set) {

                    die("Database query failed");
                }

                //Redirect to index.php
                header('Location:index.php?login_successful=true');
            } else {
                //Email or password invalid
                $errors_in_login[] = 'Invali Email /  Password';
            }
        } else {
            $errors_in_login[] = 'Database query faild';
        }
    }

}

?>

<!-- Login Process Over -->




<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/hme.css">
</head>

<body>

    <div class="Wrapper">


        <?php require_once 'inc/heder.php';?>

        <?php
if (!empty($errors)) {
    echo '<p class="error">There were Errors in Your Form.Please Submit Again.</p>';
}
if (!empty($emailerrors) && empty($errors)) {
    echo '<p class="error">The Email You Entered is Alresdy Exist.</p>';
}
if (isset($_GET['user_added_sucessfully']) && $_GET['user_added_sucessfully'] == 'true') {
    echo '<p class="cool">Account created successfully. Please Log In Now.</p>';
}

if (!empty($errors_in_login)) {
    echo '<p class="error">Email Address / Password is Invalid.</p>';
}
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    echo '<p class="cool">Successfully Logged Out.</p>';
}
if (isset($_GET['user_login']) && $_GET['user_login'] == 'false') {
    echo '<p class="error">Please Log In First.</p>';
}
?>

        <div class="SocialMedia">
            <p><span>FOLLOW US:</span>
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-google-plus-g"></i>
                <i class="fab fa-youtube"></i>
            </p>
        </div>
        <!--SocialMedia-->

        <div class="Slider">
            <div class="Slides">

                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">





                <?php

$query  = "SELECT * FROM movies WHERE is_deleted = 0 AND condi = 'Relesed' ORDER BY movie_id DESC";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $count = 0;
    $i     = 0;

    while ($row = mysqli_fetch_assoc($result)) {

        if ($i < 16) {

            if ($count == 0) {
                echo '<div class="Slide first">';
            }

            if ($count == 5) {
                echo '<div class="Slide">';
            }

            ?>

                <a href="<?php echo ("singlemovie.php?movie_id={$row['movie_id']}") ?>">
                    <div>
                        <img src="Post_images/Movies/<?php echo $row['movie_id']; ?>/<?php echo $row['main_img']; ?>"
                            alt="img1">
                        <?php $b_color = define_b_color($row['main_category']);?>
                        <h6 style="background-color: <?php echo $b_color; ?>;"><?php
if ($row['main_category'] == 'Sci_fi') {
                echo "Sci-fi";
            } else {
                echo $row['main_category'];
            }?></h6>
                        <h3><i class="fas fa-star"></i><?php echo $row['ratings'] . "/10"; ?></h3>
                        <h2><?php echo $row["m_name"]; ?></h2>
                    </div>
                </a>

                <?php

            $count++;

            if ($count == 9) {
                echo '</div><!-- Slide -->';
                $count = 5;
            }
            if ($count == 4) {
                echo '</div><!-- Slide first -->';
                $count = 5;
            }

        }

        $i++;
    }

    echo '</div><!-- Slide -->';
}

?>






                <!-- <div class="Slide first">
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide">
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide">
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide">
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					 -->



                <!--Automatic nevigation starts-->
                <div class="Nevigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
                <!--Automatic nevigation ends-->

            </div>
            <!--Slides-->

            <!--Manual nevigation starts-->
            <div class="Nevigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
            <!--Manual nevigation ends-->

        </div>
        <!--Slider-->

        <script type="text/javascript">
        var counter = 1;
        setInterval(function() {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
        </script>

        <?php require_once 'inc/hederfinal.php';?>


        <div class="Content">
            <div class="In-theater">
                <div class="topic">
                    <h2>IN THEATER <i class="fas fa-video"></i></h2><a href="movielisting.php?in_theater">
                        <h5>VIEW ALL<i class="fas fa-angle-right"></i></h5>
                    </a>
                </div>
                <div class="Ancours">
                    <a href="movielistinganchors.php?popular">#POPULAR</a>
                    <a href="movielistinganchors.php?comming_soon">#COMMING SOON</a>
                    <a href="movielistinganchors.php?top_rated">#TOP RATED</a>
                    <a href="movielistinganchors.php?most_reviewed">#MOST REVIEWED</a>
                </div>
                <!--Ancours-->

                <br>

                <div class="Slider2">
                    <div class="Slides2">

                        <input type="radio" name="radio-btn2" id="radi5">
                        <input type="radio" name="radio-btn2" id="radi6">
                        <input type="radio" name="radio-btn2" id="radi7">
                        <input type="radio" name="radio-btn2" id="radi8">





                        <?php

$query  = "SELECT * FROM movies WHERE is_deleted = 0 AND condi = 'On Theater' ORDER BY movie_id DESC";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $count = 0;
    $i     = 0;

    while ($row = mysqli_fetch_assoc($result)) {

        if ($i < 16) {

            if ($count == 0) {
                echo '<div class="Slide2 first2">';
            }

            if ($count == 5) {
                echo '<div class="Slide2">';
            }

            ?>

                        <a href="<?php echo ("singlemovie.php?movie_id={$row['movie_id']}") ?>">
                            <div>
                                <img src="Post_images/Movies/<?php echo $row['movie_id']; ?>/<?php echo $row['main_img']; ?>"
                                    alt="img1">
                                <?php $b_color = define_b_color($row['main_category']);?>
                                <h6 style="background-color: <?php echo $b_color; ?>;"><?php
if ($row['main_category'] == 'Sci_fi') {
                echo "Sci-fi";
            } else {
                echo $row['main_category'];
            }?>
                                </h6>
                                <h3><i class="fas fa-star"></i><?php echo $row['ratings'] . "/10"; ?></h3>
                                <h2><?php echo $row["m_name"]; ?></h2>
                            </div>
                        </a>

                        <?php

            $count++;

            if ($count == 9) {
                echo '</div><!-- Slide2 -->';
                $count = 5;
            }
            if ($count == 4) {
                echo '</div><!-- Slide2 first2 -->';
                $count = 5;
            }

        }

        $i++;
    }

    echo '</div><!-- Slide -->';
}

?>





                        <!-- 					<div class="Slide2 first2">
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide2">
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide2">
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide2">
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div> -->

                    </div>
                    <!--Slides2-->

                    <!--Manual nevigation starts-->
                    <div class="Nevigation-manual2">
                        <label for="radi5" class="manual-btn2"></label>
                        <label for="radi6" class="manual-btn2"></label>
                        <label for="radi7" class="manual-btn2"></label>
                        <label for="radi8" class="manual-btn2"></label>
                    </div>
                    <!--Manual nevigation ends-->

                </div>
                <!--Slider2-->

                <script type="text/javascript">
                var count = 5;
                setInterval(function() {
                    document.getElementById('radi' + count).checked = true;
                    count++;
                    if (count > 8) {
                        count = 5;
                    }
                }, 7500);
                </script>

            </div>
            <!--In-theater-->

            <div class="Sidebar">

                <div class="Advertiesment1">
                    <img src="img/app-idea-animated-1.gif">
                </div>
                <!--Advertiesment1-->

                <div class="SpotlightCelebrities">

                    <h3>SPOTLIGHT CELEBRITIES</h3>
                    <br>


                    <?php

$query  = "SELECT * FROM celebrities WHERE is_deleted  = 0 ORDER BY cbr_id DESC";
$result = mysqli_query($connection, $query);

// echo $query;
// die();

if ($result && mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($data = mysqli_fetch_assoc($result)) {

        if ($i < 4) {

            ?>

                    <a href="celebrities.php?cbr_id=<?php echo ($data['cbr_id']) ?>">
                        <div>
                            <img
                                src="Post_images/Celebrities/<?php echo $data['cbr_id']; ?>/<?php echo $data['main_img']; ?>">
                            <h4 class="Specif"><?php echo $data['c_name']; ?></h4>
                            <h5 class="Specif"><?php echo $data['u_date_time']; ?></h5>
                        </div>
                    </a>
                    <br><br><br>

                    <?php
}
        $i++;
    }
} else {
    echo "Something happend";
}
echo "<br>";
?>



                    <a href="" class="link">SEE ALL CELEBRITIES<i class="fas fa-angle-right"></i></a>

                </div>
                <!--SpotlightCelebrities-->

                <div class="Advertiesment2">
                    <img src="img/LatestMv/slider3.jpg">
                </div>
                <!--Advertiesment1-->

            </div>
            <!--Sidebar-->
            <!-- <br><br>
			<br><br> -->

            <div class="Ontv">
                <div class="topic">
                    <h2>ON TV <i class="fas fa-tv 2x"></i></h2><a href="tvserieslisting.php">
                        <h5>VIEW ALL<i class="fas fa-angle-right"></i></h5>
                    </a>
                </div>
                <div class="Ancours">
                    <a href="tvserieslistinganchors.php?popular">#POPULAR</a>
                    <a href="tvserieslistinganchors.php?comming_soon">#COMMING SOON</a>
                    <a href="tvserieslistinganchors.php?top_rated">#TOP RATED</a>
                    <a href="tvserieslistinganchors.php?most_reviewed">#MOST REVIEWED</a>
                </div>
                <!--Ancours-->

                <br>

                <div class="Slider3">
                    <div class="Slides3">

                        <input type="radio" name="radio-btn3" id="radi9">
                        <input type="radio" name="radio-btn3" id="radi10">
                        <input type="radio" name="radio-btn3" id="radi11">
                        <input type="radio" name="radio-btn3" id="radi12">





                        <?php

$query  = "SELECT * FROM tvseries WHERE is_deleted = 0 ORDER BY series_id DESC";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $count = 0;
    $i     = 0;

    while ($row = mysqli_fetch_assoc($result)) {

        if ($i < 16) {

            if ($count == 0) {
                echo '<div class="Slide3 first3">';
            }

            if ($count == 5) {
                echo '<div class="Slide3">';
            }

            ?>

                        <a href="<?php echo ("singletvseries.php?series_id={$row['series_id']}") ?>">
                            <div>
                                <img src="Post_images/TVSeries/<?php echo $row['series_id']; ?>/<?php echo $row['main_img']; ?>"
                                    alt="img1">
                                <?php $b_color = define_b_color($row['main_category']);?>
                                <h6 style="background-color: <?php echo $b_color; ?>;"><?php
if ($row['main_category'] == 'Sci_fi') {
                echo "Sci-fi";
            } else {
                echo $row['main_category'];
            }?></h6>
                                <h3><i class="fas fa-star"></i><?php echo $row['ratings'] . "/10"; ?></h3>
                                <h2><?php echo $row["s_name"]; ?></h2>
                            </div>
                        </a>

                        <?php

            $count++;

            if ($count == 9) {
                echo '</div><!-- Slide3 -->';
                $count = 5;
            }
            if ($count == 4) {
                echo '</div><!-- Slide3 first3 -->';
                $count = 5;
            }

        }

        $i++;
    }

    echo '</div><!-- Slide -->';
}

?>





                        <!-- <div class="Slide3 first3">
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider1.jpg" alt="img1"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide3">
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider2.jpg" alt="img2"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide3">
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider3.jpg" alt="img3"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
					<div class="Slide3">
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>
						<div><img src="img/LatestMv/slider4.jpg" alt="img4"><h6>Catergory</h6><h3><i class="fas fa-star"></i>Ratings/10</h3><h2>Name</h2></div>

					</div>
 -->
                    </div>
                    <!--Slides3-->

                    <!--Manual nevigation starts-->
                    <div class="Nevigation-manual3">
                        <label for="radi9" class="manual-btn3"></label>
                        <label for="radi10" class="manual-btn3"></label>
                        <label for="radi11" class="manual-btn3"></label>
                        <label for="radi12" class="manual-btn3"></label>
                    </div>
                    <!--Manual nevigation ends-->

                </div>
                <!--Slider3-->

                <script type="text/javascript">
                var cnt = 9;
                setInterval(function() {
                    document.getElementById('radi' + cnt).checked = true;
                    cnt++;
                    if (cnt > 12) {
                        cnt = 9;
                    }
                }, 6800);
                </script>



            </div>
            <!--Ontv-->
            <br>
            <div class="balance">

            </div>

        </div>
        <!--Content--->


        <div class="Content2">
            <div class="Iframe">

                <h2>IN THEATER <i class="fas fa-film 2x"></i></h2>

                <?php

$query   = "SELECT * FROM movies WHERE is_deleted = 0 AND condi = 'Relesed' ORDER BY movie_id DESC";
$result1 = mysqli_query($connection, $query);

if ($result1 && mysqli_num_rows($result1) > 0) {
    $data1 = mysqli_fetch_assoc($result1);
}

?>

                <?php

$query   = "SELECT * FROM movies WHERE is_deleted = 0 AND condi = 'Relesed' ORDER BY movie_id DESC";
$result2 = mysqli_query($connection, $query);

if ($result2 && mysqli_num_rows($result2) > 1) {
    $i = 0;

    while ($i < 2) {
        $data2 = mysqli_fetch_assoc($result2);
        $i++;
    }
}

?>

                <?php

$query   = "SELECT * FROM movies WHERE is_deleted = 0 AND condi = 'Relesed' ORDER BY movie_id DESC";
$result3 = mysqli_query($connection, $query);

if ($result3 && mysqli_num_rows($result3) > 2) {
    $i = 0;

    while ($i < 3) {
        $data3 = mysqli_fetch_assoc($result3);
        $i++;
    }
}

?>

                <?php

$query   = "SELECT * FROM movies WHERE is_deleted = 0 AND condi = 'Relesed' ORDER BY movie_id DESC";
$result4 = mysqli_query($connection, $query);

if ($result4 && mysqli_num_rows($result4) > 3) {
    $i = 0;

    while ($i < 4) {
        $data4 = mysqli_fetch_assoc($result4);
        $i++;
    }
}

?>
                <div class="iframe1"><iframe width="65%" height="432px" <?php echo $data1['off_t_e_link']; ?>></iframe>
                </div>


                <div class="iframe2" style="display: none;"><iframe width="65%" height="432px"
                        <?php echo $data2['off_t_e_link']; ?>></iframe></div>

                <div class="iframe3" style="display: none;"><iframe width="65%" height="432px"
                        <?php echo $data3['off_t_e_link']; ?>></iframe></div>

                <div class="iframe4" style="display: none;"><iframe width="65%" height="432px"
                        <?php echo $data4['off_t_e_link']; ?>></iframe></div>

                <div class="Iframe-R">


                    <div class="part1 clearfix point">
                        <div class="part">
                            <?php if (isset($data1['movie_id'])) {?>
                            <img src="Post_images/Movies/<?php echo $data1['movie_id']; ?>/<?php echo $data1['main_img']; ?>"
                                alt="tariler image">
                            <h4><?php echo $data1['m_name']; ?></h4>
                            <h5><?php echo $data1['u_date']; ?></h5><?php
}?>

                        </div>
                        <!--part-->
                    </div><!-- part1 -->
                    <div class="balance"></div>


                    <div class="part2 clearfix point">
                        <div class="part">
                            <?php if (isset($data2['movie_id'])) {?>
                            <img src="Post_images/Movies/<?php echo $data2['movie_id']; ?>/<?php echo $data2['main_img']; ?>"
                                alt="tariler image">
                            <h4><?php echo $data2['m_name']; ?></h4>
                            <h5><?php echo $data2['u_date']; ?></h5><?php
}?>
                        </div>
                        <!--part-->
                    </div><!-- part2 -->
                    <div class="balance"></div>


                    <div class="part3 clearfix point">
                        <div class="part">
                            <?php if (isset($data3['movie_id'])) {?>
                            <img src="Post_images/Movies/<?php echo $data3['movie_id']; ?>/<?php echo $data3['main_img']; ?>"
                                alt="tariler image">
                            <h4><?php echo $data3['m_name']; ?></h4>
                            <h5><?php echo $data3['u_date']; ?></h5><?php
}?>
                        </div>
                        <!--part-->
                    </div><!-- part3 -->
                    <div class="balance"></div>


                    <div class="part4 clearfix point">
                        <div class="part">
                            <?php if (isset($data4['movie_id'])) {?>
                            <img src="Post_images/Movies/<?php echo $data4['movie_id']; ?>/<?php echo $data4['main_img']; ?>"
                                alt="tariler image">
                            <h4><?php echo $data4['m_name']; ?></h4>
                            <h5><?php echo $data4['u_date']; ?></h5><?php
}?>
                        </div>
                        <!--part-->
                    </div><!-- part4 -->
                    <div class="balance"></div>


                    <script>
                    const part1 = document.querySelector(".part1");
                    const part2 = document.querySelector(".part2");
                    const part3 = document.querySelector(".part3");
                    const part4 = document.querySelector(".part4");

                    const iframe1 = document.querySelector(".iframe1");
                    const iframe2 = document.querySelector(".iframe2");
                    const iframe3 = document.querySelector(".iframe3");
                    const iframe4 = document.querySelector(".iframe4");

                    part1.addEventListener('click', () => {
                        iframe1.style.display = "block";
                        iframe2.style.display = "none";
                        iframe3.style.display = "none";
                        iframe4.style.display = "none";
                    });

                    part2.addEventListener('click', () => {
                        iframe2.style.display = "block";
                        iframe1.style.display = "none";
                        iframe3.style.display = "none";
                        iframe4.style.display = "none";
                    });

                    part3.addEventListener('click', () => {
                        iframe3.style.display = "block";
                        iframe1.style.display = "none";
                        iframe2.style.display = "none";
                        iframe4.style.display = "none";
                    });

                    part4.addEventListener('click', () => {
                        iframe4.style.display = "block";
                        iframe1.style.display = "none";
                        iframe2.style.display = "none";
                        iframe3.style.display = "none";
                    });
                    </script>


                </div>
                <!--Iframe-R-->

                <div class="balance">

                </div>

            </div>
            <!--Ifreme-->

        </div>
        <!--Content2-->


        <div class="Content3">

            <div class="Content3-L">

                <div class="Advertiesment3">
                    <img src="img/980x120.gif" alt="Advertiesment3">
                </div>
                <!--Advertiesment3-->

                <?php
$query = "SELECT * FROM latestnews WHERE is_deleted = 0 ORDER BY ltn_id DESC";
$res   = mysqli_query($connection, $query);

if ($res && mysqli_num_rows($res) > 0) {

    $i = 0;

    while ($i < 1) {
        $news1 = mysqli_fetch_assoc($res);
        $i++;
    }
    while ($i < 2) {
        $news2 = mysqli_fetch_assoc($res);
        $i++;
    }
    while ($i < 3) {
        $news3 = mysqli_fetch_assoc($res);
        $i++;
    }
    while ($i < 4) {
        $news4 = mysqli_fetch_assoc($res);
        $i++;
    }
}
?>

                <div class="LatestNews">
                    <h2>LATEST NEWS</h2>

                    <?php
if (isset($news1['ltn_id'])) {
    ?><a href="<?php echo ("latestnews.php?ltn_id={$news1['ltn_id']}"); ?>"><img
                            src="Post_images/Latestnews/<?php echo ($news1['ltn_id']); ?>/<?php echo ($news1['main_img']); ?>">
                        <h4><?php echo ($news1['n_title']); ?></h4><br>
                        <h6><?php echo ($news1['u_date_time']); ?></h6><br>
                        <p><?php echo (substr($news1['n_descrip'], 0, 300)); ?> ...</p>
                    </a><br><?php
}
?>

                </div>
                <!--LatestNews-->

                <div class="balance">

                </div>

                <div class="More">

                    <div class="More-L">
                        <h4>More news on Blockbuster</h4>

                        <?php
if (isset($news2['ltn_id'])) {
    ?><a href="<?php echo ("latestnews.php?ltn_id={$news2['ltn_id']}"); ?>"
                            class="title"><?php echo ($news2['n_title']); ?></a>
                        <h6><?php echo ($news2['u_date_time']); ?></h6><?php
}?>


                        <?php
if (isset($news3['ltn_id'])) {
    ?><a href="<?php echo ("latestnews.php?ltn_id={$news3['ltn_id']}"); ?>"
                            class="title"><?php echo ($news3['n_title']); ?></a>
                        <h6><?php echo ($news3['u_date_time']); ?></h6><?php
}?>
                    </div>
                    <!--More-L-->

                    <div class="More-R">
                        <a href="" class="go">SEE ALL MOVIES NEWS<i class="fas fa-angle-right"></i></a><br><br>

                        <?php
if (isset($news4['ltn_id'])) {
    ?><a href="<?php echo ("latestnews.php?ltn_id={$news4['ltn_id']}"); ?>"
                            class="title"><?php echo ($news4['n_title']); ?></a>
                        <h6><?php echo ($news4['u_date_time']); ?></h6><?php
}?>

                        <?php
if (isset($news5['ltn_id'])) {
    ?><a href="<?php echo ("latestnews.php?ltn_id={$news5['ltn_id']}"); ?>"
                            class="title"><?php echo ($news5['n_title']); ?></a>
                        <h6><?php echo ($news5['u_date_time']); ?></h6><?php
}?>
                    </div>
                    <!--More-R-->

                    <div class="balance">

                    </div>

                </div>
                <!--More-->

            </div>
            <!--Content3-L-->

            <div class="Content3-R">

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
                <div class="Advertiesment4">
                    <img src="img/unnamed.gif" alt="Advertiesment4">
                </div>
                <!--Advertiesment4-->

                <div class="Tweet">
                    <h3>TWEET TO US</h3>
                </div>
                <!--Tweet-->

            </div>
            <!--Content3-R-->

            <div class="balance">

            </div>

        </div>
        <!--Content3-->


        <?php require_once 'inc/footer.php'?>

        <?php require_once 'inc/signup.php'?>

        <?php require_once 'inc/login.php'?>







    </div>
    <!--Wrapper-->

</body>

</html>
<?php mysqli_close($connection);?>