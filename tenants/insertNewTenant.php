<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tenant Portal</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>

<?php
/**
 * Date: 11 Jan 2019
 * Author: Eduardo Estrada
 * Title: insertNewTenant.php 
 * Description: Allows a user to register
 */
	// security ?s and session monitor fuction, 
	// apartment list function and sanatize Data ()
	require("../utilities/utility.php");
	// connect to the db
	require("../../Tenants_variables/tenant_dbconnect.php");
    // Retrieve Post Data from the registrant
    $fName = sanatizeData($_POST["fName"]);
    $lName = sanatizeData($_POST["lName"]);
	$apt = sanatizeData($_POST["apt"]); // FK wPhone
	$hPhone = sanatizeData($_POST["hPhone"]);
	$mPhone = sanatizeData($_POST["mPhone"]);
    $wPhone = sanatizeData($_POST["wPhone"]);	
	$email = sanatizeData($_POST["email"]);
	$userPassWord = sanatizeData($_POST["userPassWord"]);
	$conFirmUserPassWord = sanatizeData($_POST["conFirmUserPassWord"]);	
	$secquest1 = sanatizeData($_POST["secquest1"]);
	$secquest2 = sanatizeData($_POST["secquest2"]);
	$secquest3 = sanatizeData($_POST["secquest3"]);
    $secAnswer1 = sanatizeData($_POST["secanwser1"]);	
	$secAnswer2 = sanatizeData($_POST["secanwser2"]);
	$secAnswer3 = sanatizeData($_POST["secanwser3"]);
	
	// password validation
	if($userPassWord === $conFirmUserPassWord){
		// the passwords are a match
		// if these 3 fields are not empty
		if (!empty($email) && !empty($userPassWord) && !empty($apt) && !empty($fName) && !empty($lName) && !empty($secAnswer1)  
			&& !empty($secAnswer2) && !empty($secAnswer1)            ){
			// check if the username already exists
			$sql0 = "SELECT  tenantEmail from Tenants where tenantEmail = '$email'";
			// returns a record
			$result = mysqli_query($conn,$sql0);
			// if query returns true
			if (mysqli_num_rows($result) > 0){
				echo "Sorry this email ".$email." already exists";
				// redirect back to login form
				header('Refresh: 2; URL = tenantRegister.php');
			} else {
				// add new user
				// SQL SELECT STATEMENT
				// encrypts password and 3 security answers
				$sql1 = "INSERT INTO Tenants (TenantEmail,TenantPassword, TenantFirstName, TenantLastName,TenantHomeNumber,
				TenantMobileNumber, TenantWorkNumber, TenantAddress_FK, TenantCity_FK, TenantState_FK, TenantZip_FK,TenantAptNum_FK) 
				VALUES ('$email',password('$userPassWord'),'$fName','$lName','$hPhone','$mPhone','$wPhone','$apt','$apt','$apt','$apt','$apt')";
				// if the insert was created	
				if ($conn->query($sql1) === TRUE) {
					//echo "New tenant record created successfully<br>";
					$last_id = $conn->insert_id;
				} else {
					echo "Error: adding the new tenant contact admin";
					// future  redirect out of this page or add some sort 
					// of contact info for user to solve the problem
				}// end if ($db->query($sql) === TRUE) 
				// insert new info to the Tenants Profile table
				$sql2 ="INSERT INTO TenantProfiles (Tenant_FK,TenantSecQues1_FK,TenantSecAns1,TenantSecQues2_FK, TenantSecAns2,
				TenantSecQues3_FK, TenantSecAns3) VALUES ('$last_id','$secquest1',password('$secAnswer1'),'$secquest2',password('$secAnswer2'),'$secquest3',password('$secAnswer3'))";

				if ($conn->query($sql2) === TRUE) {
					//echo "New tenant profile record created successfully";
					echo "
					<script>
					$( function() {
					  $( '#dialog-confirm' ).dialog({
						resizable: false,
						height: 'auto',
						width: 400,
						modal: true,
						buttons: {
						  'Ok': function() {
							$( this ).dialog( 'close' );
						  }
						}
					  });
					} );
					</script>";
					echo "
					<div id='dialog-confirm' title='Tenant Portal'>
					<p>You have successfully registered <br>You are being re-directed to log-in page</p>
					</div>";
					// redirect back to login form
					header('Refresh: 5; URL = index.html');
				} else {
					echo "Error: adding the new tenants profile table";
					// future  redirect out of this page or add some sort 
					// of contact info for user to solve the problem
				}// end if ($db->query($sql) === TRUE) 
				// close the DB connection
				mysqli_close($conn);
			}// end if ($conn->query($sql2) === TRUE)
		
		} else {
			// not a mactch
			echo "<script>alert('Required Fields are Missing!')</script>";
			// redirect back to login form
			header('Refresh: 1; URL = https://www.fbi.gov/investigate/cyber');

		}// end if (empty field)

	} else {
		// not a mactch
		echo "<script>alert('User Passwords DO NOT MATCH')</script>";
		// redirect back to login form
		header('Refresh: 1; URL = tenantRegister.php');
	} // end if (password mismatch)
?>



 

 
 

</body>
</html>