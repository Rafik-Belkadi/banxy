<?php 
/*
 Used this connection only for Sign in.

*/
// Change this to your connection info.
$DATABASE_HOST = 'banxy.appstanast.com';
$DATABASE_USER = 'user_banxy';
$DATABASE_PASS = '2Thi~o86';
$DATABASE_NAME = 'bdd_banxy';


$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
