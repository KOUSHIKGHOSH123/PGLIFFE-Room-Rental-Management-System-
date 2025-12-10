<?php
$server = "localhost";
$username = "bluebird_user";
$password = "password"; // ensure this matches
$database = "bluebirdhotel";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
