<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location:adminlogin.php?has_logged=false');
}
?>
<?php

$latestnews_list = '';
$search          = '';

//Getting the latestnews
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query  = "SELECT * FROM latestnews WHERE (ltn_id LIKE '%{$search}%' OR admin_id LIKE '%{$search}%' OR movie_name LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY ltn_id DESC";
} else {
    $query = "SELECT * FROM latestnews WHERE is_deleted = 0 ORDER BY ltn_id DESC";
}

$latestnews = mysqli_query($connection, $query);

if ($latestnews) {

    if (mysqli_num_rows($latestnews) > 0) {

        while ($latestnew = mysqli_fetch_assoc($latestnews)) {

            if ($latestnew['l_u_date_time'] == '') {$latestnew['l_u_date_time'] = "Not modified";}
            if ($latestnew['l_u_admin'] == '') {$latestnew['l_u_admin'] = "~-----~";}

            $latestnews_list .= "<tr>";
            $latestnews_list .= "<td>{$latestnew['ltn_id']}</td>";
            $latestnews_list .= "<td>{$latestnew['admin_id']}</td>";
            $latestnews_list .= "<td>{$latestnew['movie_name']}</td>";
            $latestnews_list .= "<td>{$latestnew['ratings']}</td>";
            $latestnews_list .= "<td>{$latestnew['u_date_time']}</td>";
            $latestnews_list .= "<td>{$latestnew['l_u_date_time']}</td>";
            $latestnews_list .= "<td>{$latestnew['l_u_admin']}</td>";
            $latestnews_list .= "<td><a href=\"modify-latestnew.php?ltn_id={$latestnew['ltn_id']}\"> <button class=\"edt\">Edit</button> </a></td>";
            $latestnews_list .= "<td><a href=\"delete-latestnew.php?ltn_id={$latestnew['ltn_id']}\"
									onclick=\"return confirm('Are you sure you want to delete this record?');\"> <button class=\"del\">Delete</button> </a></td>";
            $latestnews_list .= "</tr>";
        }

    } else {
        // echo "No latestnews to display";
    }

} else {
    echo "Database query failed";
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER - Admin</title>
    <link rel="stylesheet" type="text/css" href="css/add-movie-tvseries.css">
</head>

<body>
    <div class="Wrapper">

        <?php require_once 'inc/adminheader.php'?>


        <main>
            <?php if (isset($_GET['is_the_owner'])) {
    echo '<p class="error">Access Denied. Only the Owner Can Access Admins</p>';
}?>
            <?php if (isset($_GET['latestnew_modified_sucessfully'])) {
    echo '<p class="cool">Successfully Modified the News</p>';
}?>
            <?php if (isset($_GET['latestnew_added_sucessfully'])) {
    echo '<p class="cool">Successfully Uploded the News</p>';
}?>
            <?php if (isset($_GET['latestnew_found']) && $_GET['latestnew_found'] == 'false') {
    echo '<p class="error">Cant Find a News with That News ID</p>';
}?>
            <?php if (isset($_GET['query_successful']) && $_GET['query_successful'] == 'false') {
    echo '<p class="error">Database Query Failed</p>';
}?>
            <?php if (isset($_GET['set_latestnew_id']) && $_GET['set_latestnew_id'] == 'false') {
    echo '<p class="error">Please Select or Type a News to View / Modify or Delete</p>';
}?>
            <?php if (isset($_GET['latestnew_deleted']) && $_GET['latestnew_deleted'] == 'true') {
    echo '<p class="cool">News Deleted Successfully</p>';
}?>
            <?php if (isset($_GET['latestnew_deleted']) && $_GET['latestnew_deleted'] == 'false') {
    echo '<p class="error">News Deleting Failed</p>';
}?>

            <h1>Latest News
                <span>
                    <a href="add-latestnews.php"><button class="addn"><i class="fas fa-plus"></i></button></a>
                    <a href="latestnew.php"><button class="refr"><i class="fas fa-redo-alt"></i></button></a>
                </span>
            </h1>

            <div class="Search">
                <form action="latestnew.php" method="get">
                    <p>
                        <input type="text" name="search"
                            placeholder="Type Movie/Series Name, News ID or Admin Id and Hit Enter"
                            value="<?php echo $search ?>" required autofocus>
                    </p>
                </form>
            </div>

            <table class="Movie-list">
                <tr>
                    <th>News ID</th>
                    <th>Admin ID<br>(Uploaded by)</th>
                    <th>MMovie or Serirs</th>
                    <th>Ratings</th>
                    <th>Uploaded Date Time</th>
                    <th>Modified Date-time</th>
                    <th>Modified Admin</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php echo $latestnews_list; ?>

            </table><!-- Movie-list -->

        </main>

        <style>
        table.Movie-list td a button.edt:hover {
            background-color: #FF1100;
            cursor: pointer;
        }
        </style>

    </div>
    <!--Wrapper-->
</body>

</html>