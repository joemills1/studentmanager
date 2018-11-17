<?php 
// DB CONNECTION 
$server = "localhost";
$username = "root";
$password = "";
$db = "db_studentmanager";

// connect to db
$conn = mysqli_connect($server, $username, $password, $db);

// check connection
if(!$conn) {
    die("Connection failed: ".mysqli_connect_error() );
}

?>