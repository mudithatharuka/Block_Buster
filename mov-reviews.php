<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location:adminlogin.php?has_logged=false');
}
?>

<?php

$reviews_list = '';
$search       = '';

//Getting the reviews
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query  = "SELECT * FROM reviews WHERE (review_id LIKE '%{$search}%' OR post_id LIKE '%{$search}%' OR user_id LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY review_id DESC";
    // echo $query;
    // die();

} else {
    $query = "SELECT * FROM reviews WHERE is_deleted = 0 ORDER BY review_id DESC";

}

$reviews = mysqli_query($connection, $query);

if ($reviews) {

    if (mysqli_num_rows($reviews) > 0) {

        while ($review = mysqli_fetch_assoc($reviews)) {

            $reviews_list .= "<tr>";
            $reviews_list .= "<td>{$review['review_id']}</td>";
            $reviews_list .= "<td>{$review['post_id']}</td>";
            $reviews_list .= "<td>{$review['user_id']}</td>";
            $reviews_list .= "<td>{$review['r_name']}</td>";
            $reviews_list .= "<td>{$review['ratings']}</td>";
            $reviews_list .= "<td>{$review['u_date_time']}</td>";
            $reviews_list .= "<td><a href=\"delete-review.php?review_id={$review['review_id']}\"
							onclick=\"return confirm('Are you sure you want to delete this record?');\"> <button class=\"del\">Delete</button> </a></td>";
            $reviews_list .= "</tr>";
        }

    } else {
        // echo "No reviews to display";
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

            <?php if (isset($_GET['review_found']) && $_GET['review_found'] == 'false') {
    echo '<p class="error">Cant Find a Review with That Review ID</p>';
}?>
            <?php if (isset($_GET['query_successful']) && $_GET['query_successful'] == 'false') {
    echo '<p class="error">Database Query Failed</p>';
}?>
            <?php if (isset($_GET['set_review_id']) && $_GET['set_review_id'] == 'false') {
    echo '<p class="error">Please Select or Type a Review to Delete</p>';
}?>
            <?php if (isset($_GET['review_deleted']) && $_GET['review_deleted'] == 'true') {
    echo '<p class="cool">Review Deleted Successfully</p>';
}?>
            <?php if (isset($_GET['review_deleted']) && $_GET['review_deleted'] == 'false') {
    echo '<p class="error">Review Deleting Failed</p>';
}?>

            <h1>Movie Reviews
                <span>
                    <a href="mov-reviews.php"><button class="refr"><i class="fas fa-redo-alt"></i></button></a>
                </span>
            </h1>

            <div class="Search">
                <form action="mov-reviews.php" method="get">
                    <p>
                        <input type="text" name="search" placeholder="Type Review ID,Movie Id or User ID and Hit Enter"
                            value="<?php echo $search ?>" required autofocus>
                    </p>
                </form>
            </div>

            <table class="Movie-list">
                <tr>
                    <th>Review ID</th>
                    <th>Movie ID</th>
                    <th>User Id</th>
                    <th>Tittle</th>
                    <th>Ratings</th>
                    <th>Uploaded Time</th>
                    <th>Delete</th>
                </tr>

                <?php echo $reviews_list; ?>

            </table><!-- Movie-list -->

        </main>



    </div>
    <!--Wrapper-->
</body>

</html>