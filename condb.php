<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$condb = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$condb) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "";
?>


