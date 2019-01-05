<?php 
 
	/*
	
		Date: 
		Author: Eduardo Estrada
		Title: validateTheAnswer.php
		Description: 
	*/
	// get a better way to sanitize this data
	$secretAnswer = htmlspecialchars($_POST["answer"]);
	// debug 
	echo "<h3> answer = " .$secretAnswer."</h3><br>";
	validateTenantAnswer($secretAnswer);

	function validateTenantAnswer($secretAnswer){
		// get the logged in user ID from DB
		// Stored in the GLOBAL SESSION
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

	
	// debug 
	echo "<h3> answer = " .$secretAnswer."</h3><br>";

	//SQL SELECT STATEMENT -- Check the 3 answers
	$sql = "SELECT TenantProfile_ID,TenantSecAns1,TenantSecAns2,TenantSecAns3 
	FROM TenantProfiles WHERE TenantProfile_ID = '$tenantID' 
	AND TenantSecAns1 = password('$secretAnswer') OR TenantSecAns2 = password('$secretAnswer') OR TenantSecAns3 = password('$secretAnswer')";

	$result = mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($result) > 0){
		echo "MATCh";
		 // redirect to welcome page
		 header("location: tenantDash.php");
	} else {
		echo "answer does not Match";
		//header("location: welcome.php");
	}// if (mysqli_num_rows($result) > 0)	
	
	}// end validateTenantAnswer()
?>