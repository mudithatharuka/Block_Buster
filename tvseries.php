<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location:adminlogin.php?has_logged=false');
}
?>
<?php

$tvseries_list = '';
$search        = '';

//Getting the tvseries
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query  = "SELECT * FROM tvseries WHERE (series_id LIKE '%{$search}%' OR admin_id LIKE '%{$search}%' OR s_name LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY series_id DESC";
} else {
    $query = "SELECT * FROM tvseries WHERE is_deleted = 0 ORDER BY series_id DESC";
}

$tvseries = mysqli_query($connection, $query);

if ($tvseries) {

    if (mysqli_num_rows($tvseries) > 0) {

        while ($tvserie = mysqli_fetch_assoc($tvseries)) {

            if ($tvserie['l_u_date_time'] == '') {$tvserie['l_u_date_time'] = "Not modified";}
            if ($tvserie['l_u_admin'] == '') {$tvserie['l_u_admin'] = "~-----~";}

            $tvseries_list .= "<tr>";
            $tvseries_list .= "<td>{$tvserie['series_id']}</td>";
            $tvseries_list .= "<td>{$tvserie['admin_id']}</td>";
            $tvseries_list .= "<td>{$tvserie['s_name']}</td>";
            $tvseries_list .= "<td>{$tvserie['relese_date']}</td>";
            $tvseries_list .= "<td>{$tvserie['u_date']}</td>";
            $tvseries_list .= "<td>{$tvserie['u_time']}</td>";
            $tvseries_list .= "<td>{$tvserie['l_u_date_time']}</td>";
            $tvseries_list .= "<td>{$tvserie['l_u_admin']}</td>";
            $tvseries_list .= "<td><a href=\"modify-tvseries.php?series_id={$tvserie['series_id']}\"> <button class=\"edt\">Edit</button> </a></td>";
            $tvseries_list .= "<td><a href=\"delete-tvseries.php?series_id={$tvserie['series_id']}\"
								onclick=\"return confirm('Are you sure you want to delete this record?');\"> <button class=\"del\">Delete</button> </a></td>";
            $tvseries_list .= "</tr>";
        }

    } else {
        // echo "No tvseries to display";
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
            <?php if (isset($_GET['series_modified_sucessfully'])) {
    echo '<p class="cool">Successfully Modified the TV Series</p>';
}?>
            <?php if (isset($_GET['series_added_sucessfully'])) {
    echo '<p class="cool">Successfully Uploded the TV Series</p>';
}?>
            <?php if (isset($_GET['series_found']) && $_GET['series_found'] == 'false') {
    echo '<p class="error">Cant Find a TV Series with That TV Series ID</p>';
}?>
            <?php if (isset($_GET['query_successful']) && $_GET['query_successful'] == 'false') {
    echo '<p class="error">Database Query Failed</p>';
}?>
            <?php if (isset($_GET['set_series_id']) && $_GET['set_series_id'] == 'false') {
    echo '<p class="error">Please Select or Type a TV Series to View / Modify or Delete</p>';
}?>
            <?php if (isset($_GET['series_deleted']) && $_GET['series_deleted'] == 'true') {
    echo '<p class="cool">TV Series Deleted Successfully</p>';
}?>
            <?php if (isset($_GET['series_deleted']) && $_GET['series_deleted'] == 'false') {
    echo '<p class="error">TV Series Deleting Failed</p>';
}?>

            <h1>TV Series
                <span>
                    <a href="add-tvseries.php"><button class="addn"><i class="fas fa-plus"></i></button></a>
                    <a href="tvseries.php"><button class="refr"><i class="fas fa-redo-alt"></i></button></a>
                </span>
            </h1>

            <div class="Search">
                <form action="tvseries.php" method="get">
                    <p>
                        <input type="text" name="search"
                            placeholder="Type Movie Name, Movie ID or Admin Id and Hit Enter"
                            value="<?php echo $search ?>" required autofocus>
                    </p>
                </form>
            </div>

            <table class="Movie-list">
                <tr>
                    <th>Movie ID</th>
                    <th>Admin ID<br>(Uploaded by)</th>
                    <th>Movie Name</th>
                    <th>Relese Date</th>
                    <th>Uploaded Date</th>
                    <th>Uploaded Time</th>
                    <th>Modified Date-time</th>
                    <th>Modified Admin</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php echo $tvseries_list; ?>

            </table><!-- Movie-list -->

        </main>

        <style>
        table.Movie-list td a button.edt:hover {
            background-color: #FBB117;
            cursor: pointer;
        }
        </style>

    </div>
    <!--Wrapper-->
</body>

</html>