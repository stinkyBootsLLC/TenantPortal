<?php
/*SDEV 300 7980 (Lab 7)  
	Date: 17 Nov 2018
	Author: Eduardo Estrada
	Title: logout.php
	description: logs out the user session 
	and will redirect back to index.html "login form"
*/
   session_start();
   // clear the session individual variables
   unset($_SESSION['TenantID']); 
   unset($_SESSION['TenantEmail']); 
   unset($_SESSION['TenantName']); 
   unset($_SESSION['TenantAddress_FK']);
   unset($_SESSION['app_pass']);
   unset($_SESSION['app_userEmail']);
   unset($_SESSION['start_activity']);
   unset($_SESSION['Maintainer_ID']); 
   unset($_SESSION['MaintainerEmail']);
   unset($_SESSION['MaintName']);

   // display message
   echo 'You have cleaned your session and Logged out';
   session_unset();
   session_destroy(); //destroy entire session 
   // make sure the variables are empty
   echo "<h3> Session Data after Logout  </h3>
          <table border='1'>
          <tr>
          <td>Username </td>
          <td> Password </td>
          </tr>
          <tr>
          <td>" . $_SESSION['app_username'] . "</td>" .

          "<td>" . $_SESSION['app_pass'] . "</td>
          </tr>     
          </table>";
   // redirect back to login form
   header('Refresh: 5; URL = index.html');
?>