<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>
<?php

	$celebrities_list = '';
	$search = '';

	//Getting the celebrities
	if(isset($_GET['search'])){
		$search = mysqli_real_escape_string($connection, $_GET['search']);
		$query = "SELECT * FROM celebrities WHERE (cbr_id LIKE '%{$search}%' OR admin_id LIKE '%{$search}%' OR c_name LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY cbr_id DESC";
	}else{
		$query = "SELECT * FROM celebrities WHERE is_deleted = 0 ORDER BY cbr_id DESC";	
	}

	$celebrities = mysqli_query($connection, $query);

	if($celebrities){

		if(mysqli_num_rows($celebrities) > 0){

			while ($celebrity = mysqli_fetch_assoc($celebrities)) {
				
				if($celebrity['l_u_date_time'] == ''){$celebrity['l_u_date_time'] = "Not modified";}
				if($celebrity['l_u_admin'] == ''){$celebrity['l_u_admin'] = "~-----~";}

				$celebrities_list.="<tr>";
				$celebrities_list.="<td>{$celebrity['cbr_id']}</td>";
				$celebrities_list.="<td>{$celebrity['admin_id']}</td>";
				$celebrities_list.="<td>{$celebrity['c_name']}</td>";
				$celebrities_list.="<td>{$celebrity['ratings']}</td>";
				$celebrities_list.="<td>{$celebrity['u_date_time']}</td>";
				$celebrities_list.="<td>{$celebrity['l_u_date_time']}</td>";
				$celebrities_list.="<td>{$celebrity['l_u_admin']}</td>";
				$celebrities_list.="<td><a href=\"modify-celebrity.php?cbr_id={$celebrity['cbr_id']}\"> <button class=\"edt\">Edit</button> </a></td>";
				$celebrities_list.="<td><a href=\"delete-celebrity.php?cbr_id={$celebrity['cbr_id']}\"
									onclick=\"return confirm('Are you sure you want to delete this record?');\"> <button class=\"del\">Delete</button> </a></td>";
				$celebrities_list.="</tr>";
			}

		}else{
			// echo "No celebrities to display";
		}

	}else{
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

        <?php require_once('inc/adminheader.php') ?>


        <main>
            <?php if(isset($_GET['is_the_owner'])){
			echo '<p class="error">Access Denied. Only the Owner Can Access Admins</p>';
		} ?>
            <?php if(isset($_GET['celebrity_modified_sucessfully'])){
			echo '<p class="cool">Successfully Modified the Celebrity</p>';
		} ?>
            <?php if(isset($_GET['celebrity_added_sucessfully'])){
			echo '<p class="cool">Successfully Uploded the Celebrity</p>';
		} ?>
            <?php if(isset($_GET['celebrity_found']) && $_GET['celebrity_found'] == 'false' ){
			echo '<p class="error">Cant Find a Celebrity with That Celebrity ID</p>';
		} ?>
            <?php if(isset($_GET['query_successful']) && $_GET['query_successful'] == 'false' ){
			echo '<p class="error">Database Query Failed</p>';
		} ?>
            <?php if(isset($_GET['set_celebrity_id']) && $_GET['set_celebrity_id'] == 'false' ){
			echo '<p class="error">Please Select or Type a Celebrity to View / Modify or Delete</p>';
		} ?>
            <?php if(isset($_GET['celebrity_deleted']) && $_GET['celebrity_deleted'] == 'true' ){
			echo '<p class="cool">Celebrity Deleted Successfully</p>';
		} ?>
            <?php if(isset($_GET['celebrity_deleted']) && $_GET['celebrity_deleted'] == 'false' ){
			echo '<p class="error">Celebrity Deleting Failed</p>';
		} ?>

            <h1>Celebrities
                <span>
                    <a href="add-celebrity.php"><button class="addn"><i class="fas fa-plus"></i></button></a>
                    <a href="celebrity.php"><button class="refr"><i class="fas fa-redo-alt"></i></button></a>
                </span>
            </h1>

            <div class="Search">
                <form action="celebrity.php" method="get">
                    <p>
                        <input type="text" name="search"
                            placeholder="Type Celebrity Name, Celebrity ID or Admin Id and Hit Enter"
                            value="<?php echo $search ?>" required autofocus>
                    </p>
                </form>
            </div>

            <table class="Movie-list">
                <tr>
                    <th>Celebrity ID</th>
                    <th>Admin ID<br>(Uploaded by)</th>
                    <th>Celebrity Name</th>
                    <th>Ratings</th>
                    <th>Uploaded Date Time</th>
                    <th>Modified Date-time</th>
                    <th>Modified Admin</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php echo $celebrities_list; ?>

            </table><!-- Movie-list -->

        </main>

        <style>
        table.Movie-list td a button.edt:hover {
            background-color: #d6762e;
            cursor: pointer;
        }
        </style>


    </div>
    <!--Wrapper-->
</body>

</html>