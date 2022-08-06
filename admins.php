<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>
<?php

	if($_SESSION['admin_id'] != "ADM_001"){
		header('Location:adminhome.php?is_the_owner=false');
	}

?>
<?php

	$admins_list = '';

	//Getting the admins
	$query = "SELECT * FROM admins WHERE is_deleted = 0 ORDER BY admin_id";
	$admins = mysqli_query($connection, $query);

	if($admins){

		if(mysqli_num_rows($admins) > 0){

			while ($admin = mysqli_fetch_assoc($admins)) {
				
				$admins_list.="<tr>";
				$admins_list.="<td>{$admin['admin_id']}</td>";
				$admins_list.="<td>{$admin['name']}</td>";
				$admins_list.="<td>{$admin['email']}</td>";
				$admins_list.="<td>+{$admin['contact_no']}</td>";
				$admins_list.="<td>{$admin['last_login']}</td>";
				$admins_list.="<td><a href=\"modify-admin.php?admin_id={$admin['admin_id']}\"> <button class=\"edt\">Edit</button> </a></td>";
				$admins_list.="<td><a href=\"delete-admin.php?admin_id={$admin['admin_id']}\"> <button class=\"del\">Delete</button> </a></td>";
				$admins_list.="</tr>";
			}

		}else{
			echo "No admins to display";
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

            <h1>Admins
                <span>
                    <a href="admins.php"><button class="refr"><i class="fas fa-redo-alt"></i></button></a>
                </span>
            </h1>

            <table class="Movie-list">
                <tr>
                    <th>Admin ID</th>
                    <th>Admin Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Last Login</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php echo $admins_list; ?>

            </table><!-- Movie-list -->

        </main>

        <style>
        table.Movie-list td a button.edt:hover {
            background-color: #a741a2;
            cursor: pointer;
        }
        </style>

    </div>
    <!--Wrapper-->
</body>

</html>