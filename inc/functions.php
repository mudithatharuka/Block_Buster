<?php

function verify_query($result_set) {

    global $connection;

    if (!$result_set) {
        die("Database query failed: " . mysqli_error($connection));
    }

}

function is_email($email) {
    return (preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

function check_req_fields($req_fields) {
    //Check required fields
    $errors = array();

    foreach ($req_fields as $field) {
        if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
        }
    }

    return $errors;
}

function check_req_images($req_images) {
    //Check required images
    $errors = array();

    foreach ($req_images as $image) {
        if (empty($_FILES[$image]['name'])) {
            $errors[] = $image . ' is required';

        }
    }

    return $errors;
}

function check_max_len($max_len_fields) {
    //Check max lengths
    $errors = array();

    foreach ($max_len_fields as $field => $max_len) {
        if (strlen(trim($_POST[$field])) > $max_len) {
            $errors[] = $field . ' must be less than ' . $max_len . ' characters ';
        }
    }

    return $errors;
}

function display_errors($errors) {
    //Format and display the errors
    echo '<div class="errmsg">';
    echo "<b>There were error(s) in your form.</b><br>";
    foreach ($errors as $error) {
        $error = str_replace("s_", "series_", $error);
        $error = str_replace("c_", "celebrity ", $error);
        $error = str_replace("n_", "news ", $error);
        $error = str_replace("mainews", "main ", $error);
        $error = str_replace("_", " ", $error);
        $error = str_replace(" e ", " embeded ", $error);
        $error = str_replace(" t ", " trailer ", $error);
        $error = str_replace("usr ", "user ", $error);
        $error = str_replace("m ", "Movie ", $error);
        $error = str_replace("off", " Official ", $error);
        $error = str_replace("vid", " Video", $error);
        $error = str_replace("descrip", " description", $error);
        $error = str_replace("img", "image", $error);
        $error = ucfirst($error);
        echo '- ' . $error . '<br>';
    }
    echo "</div>";
}

function define_b_color($main_category) {
    $b_color = '';

    switch ($main_category) {
    case 'Action':
        $b_color = '#2196F3';
        break;
    case 'Animation':
        $b_color = '#FBB117';
        break;
    case 'Sci_fi':
        $b_color = '#03C04A';
        break;
    case 'Comady':
        $b_color = '#a741a2';
        break;
    case 'Thriller':
        $b_color = '#FF1100';
        break;
    case 'Horror':
        $b_color = '#d6762e';
        break;

    default:
        $b_color = '#eee';
        break;
    }

    return $b_color;
}
?>