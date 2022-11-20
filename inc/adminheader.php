<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="inc/css/adminheader.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>

<body>

    <header>

        <div class="Sitename"><i class="fas fa-bars"></i> BLOCK BUSTER</div>
        <!--Sitename-->

        <div class="Loggedin">Welcome Admin <?php echo $_SESSION['name']; ?>! <a href="adminlogout.php"><button>Log
                    Out</button></a></div>
    </header>

    <div class="Choosehead">
        <ul>
            <li><a href="adminhome.php"><button class="Movies">Movies</button></a></li>
            <li><a href="tvseries.php"><button class="Tv">Tv Series</button></a></li>
            <li><a href="mov-reviews.php"><button class="Movie">Movie Reviews</button></a></li>
            <li><a href="tsr-reviews.php"><button class="Series">Series Reviews</button></a></li>
            <li><a href="latestnew.php"><button class="Latest">Latest News</button></a></li>
            <li><a href="celebrity.php"><button class="Celebrities">Celebrities</button></a></li>
            <li><a href="users.php"><button class="Users">Users</button></a></li>
            <?php if ($_SESSION['admin_id'] == 'ADM_001') {?>
            <li><a href="admins.php?admin_id=<?php echo $_SESSION['admin_id'] ?>"><button
                        class="Admins">Admins</button></a></li>
            <?php }?>
        </ul>
    </div><!-- Choosehead -->

    <script>
    $(document).ready(function() {
        $('.fa-bars').click(function() {
            $('.Choosehead ul').slideToggle();
        });
    });
    </script>
</body>

</html>