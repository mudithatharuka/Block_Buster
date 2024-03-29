<?php session_start();?>
<?php require_once 'inc/connection.php'?>
<?php require_once 'inc/functions.php'?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location:adminlogin.php?has_logged=false');
}
?>

<?php

if (isset($_GET['ltn_id'])) {
    $lat_id = mysqli_real_escape_string($connection, $_GET['ltn_id']);
    $query  = "SELECT * FROM latestnews WHERE ltn_id = '{$lat_id}' AND is_deleted = 0 LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            //Latestnew found
            //Deleting the movie
            $query  = "UPDATE latestnews SET is_deleted = 1 WHERE ltn_id = '{$lat_id}' LIMIT 1";
            $result = mysqli_query($connection, $query);

            if ($result) {
                //Latestnew deleted
                header('Location:latestnew.php?latestnew_deleted=true');
            } else {
                header('Location:latestnew.php?latestnew_deleted=false');
            }

        } else {
            //Latestnew not found
            header('Location:latestnew.php?latestnew_found=false');
        }
    } else {
        //Queru unsuccessful
        header('Location:latestnew.php?query_successful=false');
    }
} else {
    header('Location:latestnew.php?set_latestnew_id=false');
}

?>


<?php mysqli_close($connection);?>