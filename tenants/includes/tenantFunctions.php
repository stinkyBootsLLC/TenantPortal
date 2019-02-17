<?php

    /**
     * Selects and displays the Tenant Record from the
     * Tenants Table 
     * @param - string
     * @param - string
     * @return NOTHING 
     */
    function selectTenantInfo($userEmail, $userPassWord){
        // connect to database
        require("../../Tenants_variables/tenant_dbconnect.php");
        //SQL SELECT STATEMENT -- encrypt the password and MATCH
        $sql = "SELECT Tenant_ID,TenantEmail,CONCAT(TenantFirstName,' ',TenantLastName) AS Name,TenantAddress_FK FROM Tenants 
        WHERE TenantEmail = '$userEmail' and TenantPassword = password('$userPassWord')";
        // mysqli_query(connection,query,resultmode); performs a query against the database.
        $result = mysqli_query($conn,$sql);
        // if the record exists in DB
        if (mysqli_num_rows($result) > 0) {
            // start the session
          //  session_start();
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
        require("../../Tenants_variables/tenant_dbconnect.php");
     //   session_start();
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

    /**
     * Matches input answer to the 3 answers in the 
     * Tenant profiles Table 
     * @param - string
     * @return NOTHING 
     */
    function validateTenantAnswer($secretAnswer){
        // get the logged in user ID from DB
        // Stored in the GLOBAL SESSION
        session_start();
        $tenantID = $_SESSION['TenantID'];
        // connect to database
        require("../../Tenants_variables/tenant_dbconnect.php"); 
        // debug 
        //echo "<h3> answer = " .$secretAnswer."</h3><br>";
        //SQL SELECT STATEMENT -- Check the 3 answers
        $sql = "SELECT TenantProfile_ID,TenantSecAns1,TenantSecAns2,TenantSecAns3 
        FROM TenantProfiles WHERE TenantProfile_ID = '$tenantID' 
        AND TenantSecAns1 = password('$secretAnswer') OR TenantSecAns2 = password('$secretAnswer') OR TenantSecAns3 = password('$secretAnswer')";
        // returned record
        $result = mysqli_query($conn,$sql);
        // if a record is returned
        if (mysqli_num_rows($result) > 0){
            echo "MATCh";
            // redirect to welcome page
            header("location: tenantDash.php");
        } else {
            echo "answer does not Match";
            header("location: ../logout.php");
        }// if (mysqli_num_rows($result) > 0)	

    }// end validateTenantAnswer()



    function displayUserProfile(){
        // get the logged in user ID from DB
        // Stored in the GLOBAL SESSION
        session_start();
        $tenantID = $_SESSION['TenantID'];
         // connect to database
         require("../../Tenants_variables/tenant_dbconnect.php");
        //SQL SELECT STATEMENT 
        $sql = "SELECT TenantEmail,CONCAT(TenantFirstName,' ',TenantLastName) AS Name,TenantHomeNumber,TenantMobileNumber,
        TenantWorkNumber,addr.Apt_street AS addr,city.Apt_City AS city,t_state.Apt_State AS t_state,zip.Apt_Zip AS zip,aptNum.Apt_number AS aptnum
        FROM Tenants 
        JOIN Apartments addr ON Tenants.TenantAddress_FK = addr.Apartment_ID
        JOIN Apartments city ON Tenants.TenantCity_FK = city.Apartment_ID
        JOIN Apartments t_state ON Tenants.TenantState_FK = t_state.Apartment_ID
        JOIN Apartments zip ON Tenants.TenantZip_FK = zip.Apartment_ID
        JOIN Apartments aptNum ON Tenants.TenantAptNum_FK = aptNum.Apartment_ID
        WHERE Tenant_ID = '$tenantID'";
                // mysqli_query(connection,query,resultmode); performs a query against the database.
         $result = mysqli_query($conn,$sql);
        // if the record exists in DB
        if (mysqli_num_rows($result) > 0) {
            echo"<div class='shadow p-3 mb-5 bg-white rounded'>";
            echo"<div class='card w-100'>";
            echo"<div class='card-body'>";
            echo "<h2>My Profile</h2>";
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // assign these variables to the GLOBAL Session
                // do not display in this function
                echo "<strong>Name:</strong> ".$row["Name"]."<br>"; 
                echo "<strong>Email:</strong> ".$row["TenantEmail"]."<br>"; 
                echo "<strong>Home Telephone #:</strong> ".$row["TenantHomeNumber"]."<br>"; 
                echo "<strong>Mobile Telephone #:</strong> ".$row["TenantMobileNumber"]."<br>"; 
                echo "<strong>Work Telephone #:</strong> ".$row["TenantWorkNumber"]."<br>"; 
                echo "<strong>Address:</strong> ".$row["addr"]."<br>"; 
                echo "<strong>City:</strong> ".$row["city"]."<br>"; 
                echo "<strong>State:</strong> ".$row["t_state"]."<br>";
                echo "<strong>Zip:</strong> ".$row["zip"]."<br>"; 
                echo "<strong>Apt #:</strong> ".$row["aptnum"]."<br>";
            } // end while($row = mysqli_fetch_assoc($result))
            echo "</div>"; 
            echo "</div>";
            echo "</div";
            } else {
                // user is NOT in the database table
                $error = "cant find infor check your sql";
                /////////////////////////////////////////////////////////////////////////////
                echo "<h1>".$error."</h1>";
                // exit out of the functions or everything else witll continue to run
                exit();
            } // end if (mysqli_num_rows($result) > 0)
        // close the DB connection
        mysqli_close($conn);
    }// end displayUserProfile

?>