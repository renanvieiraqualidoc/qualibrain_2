<?php
header('Content-Type: text/html; charset=utf-8');

//DB INFO.
$DATABASE_HOST = 'cockpit.c7yft9tue2sa.us-east-2.rds.amazonaws.com:3306';
$DATABASE_USER = 'admin';
$DATABASE_PASS = 'KyCKIVFAcmyVmwzji5uO';
$DATABASE_NAME = 'fspider';


//DB INFO.


// Try and connect using the info above.
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$conn -> set_charset("utf8");
?>
