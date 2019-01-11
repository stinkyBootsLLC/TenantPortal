<?php
    /**
     * 
     * @param - string
     * @param - string
     * 
     * @return NOTHING 
     */
    function selectTenantInfo($userEmail, $userPassWord){
        // connect to database
        require("dbconnect.php"); 
        //SQL SELECT STATEMENT -- encrypt the password and MATCH
        $sql = "SELECT Tenant_ID,TenantEmail,CONCAT(TenantFirstName,' ',TenantLastName) AS Name,TenantAddress_FK FROM Tenants 
        WHERE TenantEmail = '$userEmail' and TenantPassword = password('$userPassWord')";
        // mysqli_query(connection,query,resultmode); performs a query against the database.
        $result = mysqli_query($conn,$sql);
        // if the record exists in DB
        if (mysqli_num_rows($result) > 0) {
            // start the session
            session_start();
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // assign these variables to the GLOBAL Session
                // do not display in this function
                $_SESSION['TenantID'] = $row["Tenant_ID"]; 
                $_SESSION['TenantEmail'] = $row["TenantEmail"]; 
                $_SESSION['TenantName'] = $row["Name"]; 
                $_SESSION['TenantAddress_FK'] = $row["TenantAddress_FK"];
            } // end while($row = mysqli_fetch_assoc($result))
            } else {
                // user is NOT in the database table
                $error = "Your Login e-mail or Password is invalid";
                /////////////////////////////////////////////////////////////////////////////
                echo "<h1>".$error."</h1>";
                // exit out of the functions or everything else witll continue to run
                exit();
            } // end if (mysqli_num_rows($result) > 0)
            // close the DB connection
            mysqli_close($conn);
            // call function
            getTenantRandomQuestion();
        }// end SelectTenantInfo

        /**
         * Retrieve the users 3 security questions
         * and display one random question for validation
         */
        function getTenantRandomQuestion(){
            // connect to database
		    require("dbconnect.php");
            session_start();
            $tenantID = $_SESSION['TenantID'];
            // statment 
            $sql = "SELECT Sec1.secquest AS secQuest1,Sec2.secquest AS secQuest2, Sec3.secquest AS secQuest3  
            FROM TenantProfiles
            JOIN TenantSecQuestions Sec1 ON TenantProfiles.TenantSecQues1_FK = Sec1.secQues_ID
            JOIN TenantSecQuestions Sec2 ON TenantProfiles.TenantSecQues2_FK = Sec2.secQues_ID
            JOIN TenantSecQuestions Sec3 ON TenantProfiles.TenantSecQues3_FK = Sec3.secQues_ID
            WHERE  Tenant_FK = '$tenantID'";
            // returns a record
            $result = mysqli_query($conn,$sql);
            // if record is found
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    // assign the 3 questions to local variables
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
            // close the DB connection
            mysqli_close($conn);

        }// end getTenantRandomQuesttion

?>