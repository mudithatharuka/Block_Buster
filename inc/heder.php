<?php require_once 'inc/connection.php';?>
<?php require_once 'inc/functions.php';?>

<?php

if (isset($_GET['findtop'])) {
    $file = mysqli_real_escape_string($connection, $_GET['file']);
    $name = mysqli_real_escape_string($connection, $_GET['search']);

    header('Location:' . $file . '.php?name=' . $name . '&topsearch');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="inc/css/heder.css">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="login signup">

        <div class="Background">

            <div class="Header">

                <div class="NavBar Body clearfix">

                    <a href="index.php"><img src="img/logo1.png" alt="Logo"></a>

                    <div class="List1">
                        <ul>
                            <li><a href="index.php">HOME <i class="fas fa-home 2x"></i></a></li>
                            <li><a href="movielisting.php">MOVIES <i class="fas fa-film 2x"></i></a></li>
                            <li><a href="tvserieslisting.php">TV SERIES <i class="fas fa-tv 2x"></i></a></li>
                            <li><a href="#">ABOUT US <i class="far fa-address-card 2x"></i></a></li>
                        </ul>
                    </div>
                    <!--List1-->

                    <?php

if (isset($_SESSION['user_id'])) {

    ?>
                    <div class="List3">
                        <ul>
                            <li><a href="profile.php"><button name="profile" id="profile"><i
                                            class="fas fa-user-circle 3x"></i></button></a></li>

                            <li><a href="logout.php"><button name="logout" id="logout">LOG OUT</button></a></li>
                            <li><a href="#">CELEBRETIES</a></li>

                        </ul>
                    </div>
                    <!--List2-->
                    <?php

} else {

    ?>
                    <div class="List2">
                        <ul>
                            <li><button name="signup" id="signup">SIGN UP</button></li>

                            <li><button name="login" id="login">LOG IN</button></li>
                            <li><a href="#">CELEBRETIES</a></li>

                        </ul>
                    </div>
                    <!--List2-->
                    <?php

}

?>

                </div>
                <!--NavBar-->

                <div class="NavBarResponsive Body clearfix">

                    <div class="RespHead">
                        <img src="img/logo1.png" alt="Logo">
                        <i class="fas fa-bars"></i>
                    </div><!-- RespHead -->

                    <div class="AbsUL">

                        <div class="List1">
                            <ul>
                                <li><a href="index.php">HOME <i class="fas fa-home 2x"></i></a></li>
                                <li><a href="movielisting.php">MOVIES <i class="fas fa-film 2x"></i></a></li>
                                <li><a href="tvserieslisting.php">TV SERIES <i class="fas fa-tv 2x"></i></a></li>
                                <li><a href="#">ABOUT US <i class="far fa-address-card 2x"></i></a></li>
                                <li><a href="#">CELEBRETIES</a></li>
                            </ul>
                        </div>
                        <!--List1-->

                        <?php

if (isset($_SESSION['user_id'])) {

    ?>
                        <div class="List3">
                            <ul>
                                <li><a href="logout.php"><button name="logout" id="logout">LOG OUT</button></a></li>
                                <li><a href="profile.php"><button name="profile" id="profile"><i
                                                class="fas fa-user-circle 3x"></i></button></a></li>
                            </ul>
                        </div>
                        <!--List2-->
                        <?php

} else {

    ?>
                        <div class="List2">
                            <ul>
                                <li><button name="login" id="loginresponsive">LOG IN</button></li>
                                <li><button name="signup" id="signupresponsive">SIGN UP</button></li>
                            </ul>
                        </div>
                        <!--List2-->
                        <?php

}

?>
                    </div><!-- AbsUL -->

                </div>
                <!--NavBarResponsive-->

                <div class="balance"></div>

                <form action="index.php" method="get">
                    <div class="Search">
                        <select name="file">
                            <option value="tvserieslisting">TV SHOWS</option>
                            <option value="movielisting">MOVIES</option>
                        </select>
                        <input type="text" class="category" placeholder="Search for a movie, TV show that you want"
                            name="search" required="">
                        <button name="findtop"><i class="fas fa-search"></i></button>
                    </div>
                    <!--Search-->
                </form>
                <div class="balance"></div>
                <script>
                $(document).ready(function() {
                    $('.fa-bars').click(function() {
                        $('.NavBarResponsive .AbsUL').slideToggle();
                    });
                });
                </script>
</body>

</html>