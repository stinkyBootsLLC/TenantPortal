<?php include("Includes/userProfile.php"); ?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <title>Tenant Portal 2019</title>

        <style>
            body {background-color: rgb(234, 234, 225);}
            .topnav-right {
                float: right;
            }

        
        </style>



    </head>
  <body>



    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">Tenant Portal</a>

    </nav>

    <div class="container-fluid">
        <h3>Tenant Portal Application (BETA VER.1.0)</h3>
        <p>Random User Security Question Validation</p>
    </div>
<main> 
<div class="container">

<?php
	/*
 
	Date: 
	Author: Eduardo Estrada
	Title: 
	Description:
    */
    
    // max session time
	ini_set('session.gc_maxlifetime', 1800000); //30 min
    selectTenantInfo();
    function selectTenantInfo(){


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
                // assign these variables to the GLOBAL Session
                // do not display in this function
                $_SESSION['TenantID'] = $row["Tenant_ID"]; 
                echo $row["Tenant_ID"]."<br>"; 
                echo $row["TenantEmail"]. "<br>"; 
                echo $row["Name"]."<br>"; 
                echo $row["TenantAddress_FK"]."<br>"; 
      
            } // end while($row = mysqli_fetch_assoc($result))

  

        } else {
			  // user is NOT in the database table
			 $error = "Your Login e-mail or Password is invalid";
			 /////////////////////////////////////////////////////////////////////////////
			 echo "<h1>".$error."</h1>";
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
        
        getTenantRandomQuestion();

       }// end if($_SERVER["REQUEST_METHOD"] == "POST")

    }// end SelectTenantInfo

    function getTenantRandomQuestion(){

       
        session_start();
        $tenantID = $_SESSION['TenantID'];
  

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

        $sql = "SELECT Sec1.secquest AS secQuest1,Sec2.secquest AS secQuest2, Sec3.secquest AS secQuest3  
        FROM TenantProfiles
        JOIN TenantSecQuestions Sec1 ON TenantProfiles.TenantSecQues1_FK = Sec1.secQues_ID
        JOIN TenantSecQuestions Sec2 ON TenantProfiles.TenantSecQues2_FK = Sec2.secQues_ID
        JOIN TenantSecQuestions Sec3 ON TenantProfiles.TenantSecQues3_FK = Sec3.secQues_ID
        WHERE  Tenant_FK = '$tenantID'";

         // returns a record
		 $result = mysqli_query($conn,$sql);
		// assign the 3 questions to local variables
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
                //assign variables
                $secQuest1 = $row["secQuest1"]."<br>";
                $secQuest2 = $row["secQuest2"]."<br>";
                $secQuest3 = $row["secQuest3"]."<br>";
                // only the 3 questions for now
            }// end while

            // create a random number
			$randomQuest = rand(0,2);
			// create the question array
            $questionArray = array ($secQuest1,$secQuest2,$secQuest3);
            //display one random question from the users record
            echo "<div class='shadow p-3 mb-5 bg-white rounded'>";
            echo "<b><p>".$questionArray[$randomQuest]."</p></b>";

            echo "<form name='valSecAnswer' method='post' action='tenantValidateAnswer.php'>";
            echo "<div class='form-group'>";
      
            echo "<input type='text' class='form-control' placeholder='Secret Answer ?' name='answer' required>";
            echo "</div>";
            echo "<div class='button-panel'>";
          
            echo "<input class='btn btn-success' type='submit' value='Submit'>";
            echo "<a id='formButton' class='btn btn-danger' href='index.html'>Cancel</a>";
            echo "</div>";
            echo "</form>";
            echo "</div>";

        } else {
            echo "0 find The Users Profile Questions";
        }











    }// end getTenantRandomQuesttion
?>



</div>
</main>  




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>


























