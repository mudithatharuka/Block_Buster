<?php session_start(); ?>
<?php require_once('inc/connection.php') ?>
<?php require_once('inc/functions.php') ?>
<?php
	if(!isset($_SESSION['admin_id'])){
		header('Location:adminlogin.php?has_logged=false');
	}
?>

<?php

	$errors = array();
	$admin_id = $_SESSION['admin_id'];
	$mov_id = '';

	$m_name = '';
	$small_descrip ='';
	$m_descrip = '';
	$m_director = '';
	$m_writer = '';
	$stars = '';
	$genres = '';
	$relese_date = '';
	$year = '';
	$run_time = '';
	$ratings = '';
	$vid1_e_link = '';
	$vid2_e_link = '';
	$vid3_e_link = '';
	$off_t_e_link = '';


	if(isset($_GET['movie_id'])){
		$mov_id = mysqli_real_escape_string($connection, $_GET['movie_id']);
		$query = "SELECT * FROM movies WHERE movie_id = '{$mov_id}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//Movie found
				$result = mysqli_fetch_assoc($result_set);
					
					$m_name = $result['m_name'];
					$small_descrip =$result['small_descrip'];
					$m_descrip = $result['m_descrip'];
					$m_director = $result['m_director'];
					$m_writer = $result['m_writer'];
					$stars = $result['stars'];
					$genres = $result['genres'];
					$relese_date = $result['relese_date'];
					$year = $result['year'];
					$run_time = $result['run_time'];
					$ratings = $result['ratings'];
					$vid1_e_link = $result['vid1_e_link'];
					$vid2_e_link = $result['vid2_e_link'];
					$vid3_e_link = $result['vid3_e_link'];
					$off_t_e_link = $result['off_t_e_link'];

					$main_category = $result['main_category'];
					$action = $result['action'];
					$sci_fi = $result['sci_fi'];
					$animation = $result['animation'];
					$comady = $result['comady'];
					$thriller = $result['thriller'];
					$horror = $result['horror'];
					$language = $result['language'];
					$condition = $result['condi'];

					// $im1 = $result['im_1'];

			}else{
				//Movie not found
				header('Location:adminhome.php?movie_found=false');
			}
		}else{
			//Queru unsuccessful
			header('Location:adminhome.php?query_successful=false');
		}
	}else{
		header('Location:adminhome.php?set_movie_id=false');
	}
	 
	

	if(isset($_POST['save'])){

		$mov_id = $_POST['mov_id'];
		$m_name = $_POST['m_name'];
		$small_descrip = $_POST['small_descrip'];
		$m_descrip = $_POST['m_descrip'];
		$m_director = $_POST['m_director'];
		$m_writer = $_POST['m_writer'];
		$stars = $_POST['stars'];
		$genres = $_POST['genres'];
		$relese_date = $_POST['relese_date'];
		$year = $_POST['year'];
		$run_time = $_POST['run_time'];
		$ratings = $_POST['ratings'];
		$vid1_e_link = $_POST['vid1_e_link'];
		$vid2_e_link = $_POST['vid2_e_link'];
		$vid3_e_link = $_POST['vid3_e_link'];
		$off_t_e_link = $_POST['off_t_e_link'];



		//Checking required fields
		$req_fields =array('mov_id','m_name', 'small_descrip','m_descrip','m_director','m_writer','stars','genres','relese_date', 'year','run_time','ratings','vid1_e_link','vid2_e_link','vid3_e_link','off_t_e_link');
		$errors = array_merge($errors, check_req_fields($req_fields));

		//Checkin required images
		$req_images =array('main_img','img1','img2','img3','img4','img5','img6','img7','img8','img9','img10','img11','img12');
		$errors = array_merge($errors, check_req_images($req_images));

		//Checking max lengths
	 	$max_len_fields = array('m_name' => 100, 'small_descrip' => 150,'m_descrip' => 5000,'m_director' => 50,'m_writer' => 50,'stars' => 100,'genres' => 100,'relese_date' => 20, 'year' => 4,'run_time' => 10,'ratings' => 5,'vid1_e_link' => 1000,'vid2_e_link' => 1000,'vid3_e_link' => 1000,'off_t_e_link' => 1000);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		if(empty($errors)){

			//No errors found. Sanitize the inputs
			$m_name = mysqli_real_escape_string($connection, $_POST['m_name']);
			$small_descrip = mysqli_real_escape_string($connection, $_POST['small_descrip']);
			$m_descrip = mysqli_real_escape_string($connection, $_POST['m_descrip']);
			$m_director = mysqli_real_escape_string($connection, $_POST['m_director']);
			$m_writer = mysqli_real_escape_string($connection, $_POST['m_writer']);
			$stars = mysqli_real_escape_string($connection, $_POST['stars']);
			$genres = mysqli_real_escape_string($connection, $_POST['genres']);
			$relese_date = mysqli_real_escape_string($connection, $_POST['relese_date']);
			$year = mysqli_real_escape_string($connection, $_POST['year']);
			$run_time = mysqli_real_escape_string($connection, $_POST['run_time']);
			$ratings = mysqli_real_escape_string($connection, $_POST['ratings']);
			$vid1_e_link = mysqli_real_escape_string($connection, $_POST['vid1_e_link']);
			$vid2_e_link = mysqli_real_escape_string($connection, $_POST['vid2_e_link']);
			$vid3_e_link = mysqli_real_escape_string($connection, $_POST['vid3_e_link']);
			$off_t_e_link = mysqli_real_escape_string($connection, $_POST['off_t_e_link']);

			$main_category = $_POST['main_category'];
			$action = $_POST['action'];
			$sci_fi = $_POST['sci_fi'];
			$animation = $_POST['animation'];
			$comady = $_POST['comady'];
			$thriller = $_POST['thriller'];
			$horror = $_POST['horror'];
			$language = $_POST['language'];
			$condition = $_POST['condi'];

			$curdir = getcwd();

			$target_main = "Post_images/Movies/{$mov_id}/".basename($_FILES['main_img']['name']);
			$target1 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img1']['name']);
			$target2 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img2']['name']);
			$target3 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img3']['name']);
			$target4 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img4']['name']);
			$target5 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img5']['name']);
			$target6 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img6']['name']);
			$target7 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img7']['name']);
			$target8 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img8']['name']);
			$target9 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img9']['name']);
			$target10 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img10']['name']);
			$target11 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img11']['name']);
			$target12 = "Post_images/Movies/{$mov_id}/".basename($_FILES['img12']['name']);

			$main_im = $_FILES['main_img']['name'];
			$im1 = $_FILES['img1']['name'];
			$im2 = $_FILES['img2']['name'];
			$im3 = $_FILES['img3']['name'];
			$im4 = $_FILES['img4']['name'];
			$im5 = $_FILES['img5']['name'];
			$im6 = $_FILES['img6']['name'];
			$im7 = $_FILES['img7']['name'];
			$im8 = $_FILES['img8']['name'];
			$im9 = $_FILES['img9']['name'];
			$im10 = $_FILES['img10']['name'];
			$im11 = $_FILES['img11']['name'];
			$im12 = $_FILES['img12']['name'];

			//Time zone is set to Asian time zone
			date_default_timezone_set("Asia/Kolkata");
			date_default_timezone_get();
			$l_u_date_time = date("Y-m-d G:i:sa");
			

			//Insert to table movies
			$query = "UPDATE movies SET m_name = '{$m_name}', main_img = '{$main_im}', small_descrip = '{$small_descrip}', m_descrip = '{$m_descrip}', m_director = '{$m_director}', m_writer = '{$m_writer}', stars = '{$stars}', genres = '{$genres}', main_category = '{$main_category}', action = '{$action}', sci_fi = '{$sci_fi}', animation = '{$animation}', comady = '{$comady}', thriller = '{$thriller}', horror = '{$horror}', language = '{$language}', condi = '{$condition}', relese_date = '{$relese_date}', year = '{$year}', run_time = '{$run_time}', ratings = '{$ratings}', vid1_e_link = '{$vid1_e_link}', vid2_e_link = '{$vid2_e_link}', vid3_e_link = '{$vid3_e_link}', off_t_e_link = '{$off_t_e_link}', im_1 = '{$im1}', im_2 = '{$im2}', im_3 = '{$im3}', im_4 = '{$im4}', im_5 = '{$im5}', im_6 = '{$im6}', im_7 = '{$im7}', im_8 = '{$im8}', im_9 = '{$im9}', im_10 = '{$im10}', im_11 = '{$im11}', im_12 = '{$im12}', l_u_date_time = '{$l_u_date_time}', l_u_admin = '{$admin_id}' WHERE movie_id = '{$mov_id}' LIMIT 1";

			$result_set = mysqli_query($connection, $query);

			if($result_set){
				//Query successful

				if(move_uploaded_file($_FILES['main_img']['tmp_name'], $target_main) && move_uploaded_file($_FILES['img1']['tmp_name'], $target1) && move_uploaded_file($_FILES['img2']['tmp_name'], $target2) && move_uploaded_file($_FILES['img3']['tmp_name'], $target3) && move_uploaded_file($_FILES['img4']['tmp_name'], $target4) && move_uploaded_file($_FILES['img5']['tmp_name'], $target5) && move_uploaded_file($_FILES['img6']['tmp_name'], $target6) && move_uploaded_file($_FILES['img7']['tmp_name'], $target7) && move_uploaded_file($_FILES['img8']['tmp_name'], $target8) && move_uploaded_file($_FILES['img9']['tmp_name'], $target9) && move_uploaded_file($_FILES['img10']['tmp_name'], $target10) && move_uploaded_file($_FILES['img11']['tmp_name'], $target11) && move_uploaded_file($_FILES['img12']['tmp_name'], $target12)){

					header('Location:adminhome.php?movie_modified_sucessfully=true');

				}else{
					$errors[] = 'Modification failed. Uploded immages did not saved';
				}

			}else{
				//Query unsucessful
				$errors[] = 'Database query failed';
				// echo mysqli_error($connection);
			}

		}

	}



?>

<!DOCTYPE html>
<html>

<head>
    <title>BLOCK BUSTER > Admin</title>
    <link rel="stylesheet" type="text/css" href="css/add-movie-tvseries.css">
</head>

<body>

    <?php require_once('inc/adminheader.php') ?>

    <div class="Content">
        <h1>Modify / View Movie</h1>
        <a href="adminhome.php"><i class="fas fa-arrow-circle-left"></i></a>
        <div class="balance"></div>

        <?php
			if(!empty($errors)){
				display_errors($errors);
			}
		?>

        <form method="post" action="modify-movie.php" enctype="multipart/form-data">

            <input type="hidden" name="mov_id" value="<?php echo $mov_id ?>">

            <p>
                <label>Movie Name:</label>
                <input type="text" name="m_name" placeholder=" Add name" <?php echo 'value="' .$m_name. '"'; ?>>
            </p>
            <div class="balance"></div>

            <p>
                <label>Main image:</label>
                <input type="file" id="im" name="main_img" accept="image/*">
            </p>

            <div class="balance"></div>
            <p class="small-descrip">
                <label>Small Description:</label>
                <input name="small_descrip" placeholder=" Add a small description"
                    <?php echo 'value="' .$small_descrip. '"'; ?>>
            </p>

            <div class="balance"></div>
            <p class="m-descrip">
                <label>Movie Description:</label>
                <textarea name="m_descrip" placeholder=" Add a description"><?php echo "{$m_descrip}";; ?></textarea>
                <!-- <textarea class="article-input" id="article-input" type="text" rows="9" >{{article}}</textarea> -->
            </p>

            <div class="balance"></div>

            <p>
                <label>Movie Director:</label>
                <input type="text" name="m_director" placeholder=" Add director"
                    <?php echo 'value="' .$m_director. '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Movie Writer:</label>
                <input type="text" name="m_writer" placeholder=" Add writer" <?php echo 'value="' .$m_writer. '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Stars:</label>
                <input type="text" name="stars" placeholder=" Add stars with <br>"
                    <?php echo 'value="' .$stars. '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Genres:</label>
                <input type="text" name="genres" placeholder=" Add genreses with <br>"
                    <?php echo 'value="' .$genres. '"'; ?>>
            </p>

            <div class="balance"></div>

            <p>
                <label>Main category:</label>
                <select name="main_category">
                    <option><?php echo "{$main_category}" ?></option>
                    <?php switch ($main_category) {
						case 'Action':
							?>
                    <option value="Sci_fi">Sci-fi</option>
                    <option>Animation</option>
                    <option>Comady</option>
                    <option>Thriller</option>
                    <option>Horror</option>
                    <?php
							break;
						case 'Sci-fi':
							?>
                    <option>Action</option>
                    <option>Animation</option>
                    <option>Comady</option>
                    <option>Thriller</option>
                    <option>Horror</option>
                    <?php
							break;
						case 'Animation':
							?>
                    <option>Action</option>
                    <option value="Sci_fi">Sci-fi</option>
                    <option>Comady</option>
                    <option>Thriller</option>
                    <option>Horror</option>
                    <?php
							break;
						case 'Comady':
							?>
                    <option>Action</option>
                    <option value="Sci_fi">Sci-fi</option>
                    <option>Animation</option>
                    <option>Thriller</option>
                    <option>Horror</option>
                    <?php
							break;
						case 'Thriller':
							?>
                    <option>Action</option>
                    <option value="Sci_fi">Sci-fi</option>
                    <option>Animation</option>
                    <option>Comady</option>
                    <option>Horror</option>
                    <?php
							break;
						case 'Horror':
							?>
                    <option>Action</option>
                    <option value="Sci_fi">Sci-fi</option>
                    <option>Animation</option>
                    <option>Comady</option>
                    <option>Thriller</option>
                    <?php
							break;
						
						default:
							# code...
							break;
					} ?>
                    <!-- <option>Action</option>
					<option>Sci-fi</option>
					<option>Animation</option>
					<option>Comady</option>
					<option>Thriller</option>
					<option>Horror</option> -->
                </select>
            </p>

            <div class="balance"></div>
            <p>
                <label>Sub categories:</label>
            </p>
            <br>
            <div class="balance"></div>
            <div class="Sub-cat">

                <p>
                    <label>Action</label>
                    <select name="action">
                        <option><?php echo "{$action}" ?></option>
                        <?php switch ($action) {
						case 'Yes':
							?> <option>No</option> <?php
							break;
						case 'No':
							?> <option>Yes</option> <?php
							break;
						default:
							# code...
							break;
					} ?>
                        <!-- <option>Yes</option>
					<option>No</option> -->
                    </select>
                </p>
                <p>
                    <label>Sci-fi</label>
                    <select name="sci_fi">
                        <option><?php echo "{$sci_fi}" ?></option>
                        <?php switch ($sci_fi) {
						case 'Yes':
							?> <option>No</option> <?php
							break;
						case 'No':
							?> <option>Yes</option> <?php
							break;
						default:
							# code...
							break;
					} ?>
                        <!-- <option>Yes</option>
					<option>No</option> -->
                    </select>
                </p>
                <p>
                    <label>Animatiion</label>
                    <select name="animation">
                        <option><?php echo "{$animation}" ?></option>
                        <?php switch ($animation) {
						case 'Yes':
							?> <option>No</option> <?php
							break;
						case 'No':
							?> <option>Yes</option> <?php
							break;
						default:
							# code...
							break;
					} ?>
                        <!-- <option>Yes</option>
					<option>No</option> -->
                    </select>
                </p>
                <p>
                    <label>Comady</label>
                    <select name="comady">
                        <option><?php echo "{$comady}" ?></option>
                        <?php switch ($comady) {
						case 'Yes':
							?> <option>No</option> <?php
							break;
						case 'No':
							?> <option>Yes</option> <?php
							break;
						default:
							# code...
							break;
					} ?>
                        <!-- <option>Yes</option>
					<option>No</option> -->
                    </select>
                </p>
                <p>
                    <label>Thriller</label>
                    <select name="thriller">
                        <option><?php echo "{$thriller}" ?></option>
                        <?php switch ($thriller) {
						case 'Yes':
							?> <option>No</option> <?php
							break;
						case 'No':
							?> <option>Yes</option> <?php
							break;
						default:
							# code...
							break;
					} ?>
                        <!-- <option>Yes</option>
					<option>No</option> -->
                    </select>
                </p>
                <p>
                    <label>Horror</label>
                    <select name="horror">
                        <option><?php echo "{$horror}" ?></option>
                        <?php switch ($horror) {
						case 'Yes':
							?> <option>No</option> <?php
							break;
						case 'No':
							?> <option>Yes</option> <?php
							break;
						default:
							# code...
							break;
					} ?>
                        <!-- <option>Yes</option>
					<option>No</option> -->
                    </select>
                </p>

            </div><!-- Sub-cat -->
            <div class="balance"></div>
            <p>
                <label>Language:</label>
                <select name="language">
                    <option><?php echo "{$language}" ?></option>
                    <?php switch ($language) {
						case 'Hollywood':
							?> <option>Bollywood</option>
                    <option>Collywood</option> <?php
							break;
						case 'Bollywood':
							?> <option>Hollywood</option>
                    <option>Collywood</option> <?php
							break;
						case 'Collywood':
							?> <option>Hollywood</option>
                    <option>Bollywood</option> <?php
							break;
						
						default:
							# code...
							break;
					} ?>
                    <!-- <option>Hollywood</option>
					<option>Bollywood</option>
					<option>Collywood</option> -->
                </select>
            </p>
            <div class="balance"></div>
            <p>
                <label>Condition:</label>
                <select name="condi">
                    <option><?php echo "{$condition}" ?></option>
                    <?php switch ($condition) {
						case 'Relesed':
							?> <option>On Theater</option>
                    <option>Comming soon</option> <?php
							break;
						case 'On Theater':
							?> <option>Relesed</option>
                    <option>Comming soon</option> <?php
							break;
						case 'Comming soon':
							?> <option>Relesed</option>
                    <option>On Theater</option> <?php
							break;
						
						default:
							# code...
							break;
					} ?>
                    <!-- <option>Relesed</option>
					<option>On Theater</option>
					<option>Comming soon</option> -->
                </select>
            </p>
            <div class="balance"></div>
            <p>
                <label>Relese date:</label>
                <input type="text" name="relese_date" placeholder=" Relese date(by letters)"
                    <?php echo 'value="' .$relese_date. '"'; ?>>
            </p>
            <div class="balance"></div>
            <p>
                <label>Year:</label>
                <input type="number" name="year" placeholder=" Year" <?php echo 'value="' .$year. '"'; ?>>
            </p>
            <div class="balance"></div>
            <p>
                <label>Run time:</label>
                <input type="text" name="run_time" placeholder=" Run time(by mins)"
                    <?php echo 'value="' .$run_time. '"'; ?>>
            </p>
            <div class="balance"></div>
            <p>
                <label>Ratings:</label>
                <input type="number" name="ratings" placeholder=" IMDB ratings(<=10)"
                    <?php echo 'value="' .$ratings. '"'; ?>>
            </p>
            <div class="balance"></div>
            <p>
                <label>Embedded video 01:</label>
                <input type="text" name="vid1_e_link" placeholder=" Embedded video link 01 (without attributes)"
                    <?php echo 'value="' .$vid1_e_link. '"'; ?>>
            </p>
            <div class="balance"></div>
            <p>
                <label>Embedded video 02:</label>
                <input type="text" name="vid2_e_link" placeholder=" Embedded video link 02 (without attributes)"
                    <?php echo 'value="' .$vid2_e_link. '"'; ?>>
            </p>
            <div class="balance"></div>
            <p>
                <label>Embedded video 03:</label>
                <input type="text" name="vid3_e_link" placeholder=" Embedded video link 03 (without attributes)"
                    <?php echo 'value="' .$vid3_e_link. '"'; ?>>
            </p>
            <div class="balance"></div>
            <p>
                <label>Official trailer:</label>
                <input type="text" name="off_t_e_link"
                    placeholder=" Official trailer embedded link (without attributes)"
                    <?php echo 'value="' .$off_t_e_link. '"'; ?>>
            </p>
            <div class="balance"></div>

            <p>
                <label>Image 01:</label>
                <input type="file" id="im" name="img1" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 02:</label>
                <input type="file" id="im" name="img2" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 03:</label>
                <input type="file" id="im" name="img3" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 04:</label>
                <input type="file" id="im" name="img4" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 05:</label>
                <input type="file" id="im" name="img5" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 06:</label>
                <input type="file" id="im" name="img6" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 07:</label>
                <input type="file" id="im" name="img7" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 08:</label>
                <input type="file" id="im" name="img8" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 09:</label>
                <input type="file" id="im" name="img9" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 10:</label>
                <input type="file" id="im" name="img10" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 11:</label>
                <input type="file" id="im" name="img11" accept="image/*">
            </p>
            <div class="balance"></div>
            <p>
                <label>Image 12:</label>
                <input type="file" id="im" name="img12" accept="image/*">
            </p>
            <div class="balance"></div>

            <button name="save">SAVE CHANGES</button>

        </form>
    </div><!-- Content -->

    <style>
    .Content button:hover {
        background-color: #2196F3;
    }

    .Content a i:hover {
        color: #2196F3;
    }
    </style>

</body>

</html>
<?php mysqli_close($connection); ?>