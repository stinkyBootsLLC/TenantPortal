<?php
	/*
 
	Date: 
	Author: Eduardo Estrada
	Title: 
	Description:
	*/


	// max session time
	ini_set('session.gc_maxlifetime', 1800000); //30 min

    // Retrieve Post Data
    $userEmail= $_POST["userEmail"];
    $userPassWord = $_POST["userPassWord"];	
    $userCookie = $_POST["rememberMe"];

    // Set the session information  
    // PHP session default time = 30min
    session_start();
    $_SESSION['app_rememberMe'] = $userrememberMe; 
    $_SESSION['app_userEmail'] = htmlspecialchars($userEmail); 
    $_SESSION['app_pass'] = htmlspecialchars($userPassWord);
	// get the current time to monitor the session
    // $_SESSION['start_activity'] = time();
	// // if NOT empty
    // if(!empty($_POST["rememberMe"])) {
    //     // set cookies for login info 
    //     setcookie("userName", $_POST["userName"], time()+ 60,'/'); // expires after 60 seconds
    //     setcookie("emailAddress", $_POST["emailAddress"], time()+ 60,'/'); // expires after 60 seconds
    //     setcookie("userPassWord", $_POST["userPassWord"], time()+ 60,'/'); // expires after 60 seconds

    // }// end if

	// validate the user against the database "gameapp" table "gameusers"
	   if($_SERVER["REQUEST_METHOD"] == "POST") {
        // //sanatize the data
        // $gameusername = mysqli_real_escape_string($db,$_POST['userEmail']);
        // $gamepassword = mysqli_real_escape_string($db,$_POST['userPassWord']);

        // connect to database
        $servername = "localhost";
        $username = "tenant_user";
        $password = "user4TenantPortal";
        $dbname = "TenantPortal";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        
        //SQL SELECT STATEMENT -- encrypt the password and MATCH
        $sql = "SELECT Tenant_ID,TenantEmail,CONCAT(TenantFirstName,' ',TenantLastName) AS Name,TenantAddress_FK FROM Tenants 
        WHERE TenantEmail = '$userEmail' and TenantPassword = password('$userPassWord')";
        // mysqli_query(connection,query,resultmode); performs a query against the database.
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {


            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              
                echo $row["Tenant_ID"]."<br>"; 
                echo $row["TenantEmail"]. "<br>"; 
                echo $row["Name"]."<br>"; 
                echo $row["TenantAddress_FK"]."<br>"; 
      
            } // end while($row = mysqli_fetch_assoc($result))






        } else {
        echo "0 closed results found";
        } // end if (mysqli_num_rows($result) > 0)
        // close the DB connection
        mysqli_close($conn);
          









		//   // fetches a result row as a associative array
		//   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		//   $active = $row['active'];
		//   // returns a 1 or 0
		//   $count = mysqli_num_rows($result);
		//   // If result matched $gameusername and $gamepassword, table row must be 1 row
		//   if($count == 1) {
		// 	 $_SESSION['login_user'] = $gameusername;
		// 	 // redirect to validateUser page
		// 	 header("location: tenantDash.php");
		//   }else {
		// 	  // user is NOT in the database table
		// 	 $error = "Your Login Name or Password is invalid";
		// 	 /////////////////////////////////////////////////////////////////////////////
		// 	 echo "<h1>".$error."</h1>";
		// 	 //echo $gameusername. "  " .$gamepassword."<br>";
			 
        //   }// end if($count == 1)
        


	   }// end if($_SERVER["REQUEST_METHOD"] == "POST")
?>


























