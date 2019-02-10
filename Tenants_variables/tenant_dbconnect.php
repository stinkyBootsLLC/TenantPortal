<?php
	/*  
	Date: 9 December 2018
	Author: Eduardo Estrada
	Title: dbconnect.php
	Description: Database connection variables
	*/
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'tenant_user'); //tenant_user
   define('DB_PASSWORD', 'user4TenantPortal'); // 
   define('DB_DATABASE', 'TenantPortal');

   $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    /* check connection */
	if (!$conn) {
		die("There has been an error -18");
	} 

?>

