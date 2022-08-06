<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location:adminlogin.php?has_logged=false');
}
?>

<?php

    $users_list = '';
$search = '';

//Getting the users
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query = "SELECT * FROM users WHERE (user_id LIKE '%{$search}%' OR name LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY user_id DESC";
} else {
    $query = "SELECT * FROM users WHERE is_deleted = 0 ORDER BY user_id DESC";
}


$users = mysqli_query($connection, $query);

if ($users) {
    if (mysqli_num_rows($users) > 0) {
        while ($user = mysqli_fetch_assoc($users)) {
            $users_list.="<tr>";
            $users_list.="<td>{$user['user_id']}</td>";
            $users_list.="<td>{$user['name']}</td>";
            $users_list.="<td>{$user['email']}</td>";
            $users_list.="<td>{$user['last_login']}</td>";
            $users_list.="<td><a href=\"modify-user.php?user_id={$user['user_id']}\"> <button class=\"edt\">Edit</button> </a></td>";
            $users_list.="<td><a href=\"delete-user.php?user_id={$user['user_id']}\"
								onclick=\"return confirm('Are you sure you want to delete this record?');\"> <button class=\"del\">Delete</button> </a></td>";
            $users_list.="</tr>";
        }
    } else {
        //echo "No users to display";
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

        <?php require_once('inc/adminheader.php') ?>


        <main>

            <?php if (isset($_GET['user_modified_sucessfully'])) {
			    echo '<p class="cool">Successfully Modified the User</p>';
			} ?>
            <?php if (isset($_GET['user_added_sucessfully'])) {
			    echo '<p class="cool">Successfully Added the User</p>';
			} ?>
            <?php if (isset($_GET['user_found']) && $_GET['user_found'] == 'false') {
			    echo '<p class="error">Cant Find a User with That User ID</p>';
			} ?>
            <?php if (isset($_GET['query_successful']) && $_GET['query_successful'] == 'false') {
			    echo '<p class="error">Database Query Failed</p>';
			} ?>
            <?php if (isset($_GET['set_user_id']) && $_GET['set_user_id'] == 'false') {
			    echo '<p class="error">Please Select or Type a User to View / Modify or Delete</p>';
			} ?>
            <?php if (isset($_GET['user_deleted']) && $_GET['user_deleted'] == 'true') {
			    echo '<p class="cool">User Deleted Successfully</p>';
			} ?>
            <?php if (isset($_GET['user_deleted']) && $_GET['user_deleted'] == 'false') {
			    echo '<p class="error">User Deleting Failed</p>';
			} ?>

            <h1>Users
                <span>
                    <a href="add-user.php"><button class="addn"><i class="fas fa-plus"></i></button></a>
                    <a href="users.php"><button class="refr"><i class="fas fa-redo-alt"></i></button></a>
                </span>
            </h1>

            <div class="Search">
                <form action="users.php" method="get">
                    <p>
                        <input type="text" name="search" placeholder="Type User Name or User ID and Hit Enter"
                            value="<?php echo $search ?>" required autofocus>
                    </p>
                </form>
            </div>

            <table class="Movie-list">
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Last Login</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php echo $users_list; ?>

            </table><!-- Movie-list -->

        </main>

        <style>
        table.Movie-list td a button.edt:hover {
            background-color: #03C04A;
            cursor: pointer;
        }
        </style>

    </div>
    <!--Wrapper-->
</body>

</html>