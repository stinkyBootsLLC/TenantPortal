<?php
	/*  
	Date: 12 January 2019
	Author: Eduardo Estrada
	Title: dbconnect.php
	Description: Database connection variables
	*/
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'tenant_owner'); 
   define('DB_PASSWORD', 'owner4TenantPortal');  
   define('DB_DATABASE', 'TenantPortal');

//    define('DB_SERVER', 'localhost');
//    define('DB_USERNAME', 'tenant_owner'); 
//    define('DB_PASSWORD', 'owner4TenantPortal');  
//    define('DB_DATABASE', 'TenantPortal');

   $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    /* check connection */
	if (!$conn) {
		die("There has been an error -18");
	} 

?>

