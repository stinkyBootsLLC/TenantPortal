<?php

    /**
     * Sanatize untrusted data
     * @param string
     * @return string
     */
    function sanatizeData($data){
		// this is causing fatal error in PHP 7
        // $escapeData = mysql_escape_string( trim($data) );
		$specCharData = htmlspecialchars($data);
		$cleanData = str_replace(array(':', '-', '/', '*','=','?'), '', $specCharData);
        return $cleanData;
    }// end sanatize data



    /**
     * Monitor the Login Session for 30 minutes
     */
    function monitorSession(){
        $secondsInactive = time() - $_SESSION['start_activity'];
        $expireAfter = 30 * 60;// 30 minutes
        if(isset($_SESSION['start_activity'])){  
            $expireAfterSeconds = $expireAfter * 1;
            if($secondsInactive >= $expireAfterSeconds){
                // logout the user
                header('Refresh: 0; URL = ../logout.php');
            }
        }// end if
    }// end monitorSession()


    /**
	 * used to display the questions from the database
	 */
	function registerQuestions(){
		echo "register questions";
		// connect to database
		require("../../Tenants_variables/tenant_dbconnect.php");

		// sql 
		$sql = "SELECT * FROM TenantSecQuestions";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			echo "<option value=''>Select Question:</option>";
			// output data of each row
			// the ID will be the value to store as a foreign Key
			while($row = mysqli_fetch_assoc($result)) {
				echo "<option value=".$row["secQues_ID"]. "> ". $row["secquest"]."</option>";
			}
			echo "</select>";
	 		echo "</fieldset>";
		} else {
			echo "0 questions";
		}
		// close connection
		mysqli_close($conn);
	}// end registerQuestions()





	function apartments(){
		echo "register questions";
		// connect to database
		require("../../Tenants_variables/tenant_dbconnect.php");

		// sql 
		$sql = "SELECT * FROM Apartments";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			echo "<option value=''>Select Apartment:</option>";
			// output data of each row
			// the ID will be the value to store as a foreign Key
			while($row = mysqli_fetch_assoc($result)) {
				echo "<option value=".$row["Apartment_ID"]. "> ". $row["Apt_number"]."</option>";
			}
			echo "</select>";
	 		echo "</fieldset>";
		} else {
			echo "0 questions";
		}
		// close connection
		mysqli_close($conn);
	}// end registerQuestions()




?>