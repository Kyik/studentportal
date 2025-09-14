<?php
$host = "studentdb.c3m4my2w227j.us-east-1.rds.amazonaws.com";  // your RDS endpoint
$user = "admin";   // your RDS username
$pass = "studentDB"; 
$dbname = "student_db";

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
