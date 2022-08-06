<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location:adminlogin.php?has_logged=false');
}
?>

<?php

if (isset($_GET['review_id'])) {
    $rev_id = mysqli_real_escape_string($connection, $_GET['review_id']);
    $query  = "SELECT * FROM tsrreviews WHERE review_id = '{$rev_id}' AND is_deleted = 0 LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            //Review found
            //Deleting the Review
            $query  = "UPDATE tsrreviews SET is_deleted = 1 WHERE review_id = '{$rev_id}' LIMIT 1";
            $result = mysqli_query($connection, $query);

            if ($result) {
                //Review deleted
                header('Location:tsr-reviews.php?review_deleted=true');
            } else {
                header('Location:tsr-reviews.php?review_deleted=false');
            }

        } else {
            //Review not found
            header('Location:tsr-reviews.php?review_found=false');
        }
    } else {
        //Queru unsuccessful
        header('Location:tsr-reviews.php?query_successful=false');
    }
} else {
    header('Location:tsr-reviews.php?set_review_id=false');
}

?>


<?php mysqli_close($connection);?>