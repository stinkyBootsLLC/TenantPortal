<?php 
 
/** 
 * Date: 
 * Author: Eduardo Estrada
 * Title: tenantValidateTheAnswer.php
 * Description: compares the users input security answer
 * to the USERS security answers in the database
*/
	include("includes/maintainerFunctions.php");
	include("../utilities/utility.php");
	// sanitize the POST data
	$secretAnswer = sanatizeData($_POST["answer"]);
	// call function
	validateTenantAnswer($secretAnswer);	
?>