<?php

define('DB_HOST', "xyzuni-db.c3m4my2w227j.us-east-1.rds.amazonaws.com");
define('DB_USER', "admin");
define('DB_PASS', "cllee0311.");
define('DB_NAME', "STUDENTS");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
