<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>BLOCK BUSTER > Admin</title>
	<link rel="stylesheet" type="text/css" href="css/add-movie-tvseries.css">
</head>
<body>

	<header>
		<div class="Sitename">BLOCK BUSTER</div><!--Sitename-->
		<div class="Loggedin">Welcome Admin <?php echo $_SESSION['name'];?>! <a href="adminlogout.php">Log Out</a></div>
	</header>

	<div class="Content">
		<h1>Add Movies</h1>

		<p>
			<label>Movie Name</label>
			<input type="text" name="m_name">
		</p>
	</div><!-- Content -->

</body>
</html>