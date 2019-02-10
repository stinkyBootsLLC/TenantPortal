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
	$secquest1 = sanatizeData($_POST["secquest1"]);
	$secquest2 = sanatizeData($_POST["secquest2"]);
	$secquest3 = sanatizeData($_POST["secquest3"]);
    $secAnswer1 = sanatizeData($_POST["secanwser1"]);	
	$secAnswer2 = sanatizeData($_POST["secanwser2"]);
	$secAnswer3 = sanatizeData($_POST["secanwser3"]);
	// if these 3 fields are not empty
	if (!empty($email) && !empty($userPassWord) && !empty($apt)){
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
				echo "New tenant record created successfully<br>";
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
				echo "New tenant profile record created successfully";
				// redirect back to login form
				header('Refresh: 1; URL = index.html');
			} else {
				echo "Error: adding the new tenants profile table";
				// future  redirect out of this page or add some sort 
				// of contact info for user to solve the problem
			}// end if ($db->query($sql) === TRUE) 
			// close the DB connection
			mysqli_close($conn);
		}// end if ($conn->query($sql2) === TRUE)
	
	}//if (!empty($email) && !empty($userPassWord) && !empty($apt))
?>