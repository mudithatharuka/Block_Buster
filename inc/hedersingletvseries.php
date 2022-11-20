<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="inc/css/hedersingletvseries.css">
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
</body>

</html>