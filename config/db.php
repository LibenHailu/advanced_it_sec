<?php
$server = "localhost";
$user = "root";
$password = "admin";
$dbname = "feedback";

$conn =  mysqli_connect($server, $user, $password, $dbname);

if (!$conn) {
    die("Connection failure" . mysqli_connect_error());
}