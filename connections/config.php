<?php
$servername = "localhost";
$username = "id499121_mrfinder";
$password = "mrfinder";
$database = "id499121_mrfinder";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>