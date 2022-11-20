<?php

//$connection = mysql_connect(dbserver,dbuser,dbpass,dbname);
$connection = mysqli_connect('localhost', 'root', '', 'blockbusterb');

if (mysqli_connect_errno()) {
    die('Database Connection Error : ' . mysqli_connect_error());
}