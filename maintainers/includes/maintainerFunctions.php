<?php

    /**
     * Selects and displays the Tenant Record from the
     * Tenants Table 
     * @param - string
     * @param - string
     * @return NOTHING 
     */
    function selectMaintInfo($userEmail, $userPassWord){
        // parameters are already sanitized at this point
        // connect to database
        require("../../Tenants_variables/maint_dbconnect.php");
        $clean_userEmail = mysqli_real_escape_string($conn,$userEmail);
        $clean_userPassWord = mysqli_real_escape_string($conn,$userPassWord); 
        //SQL SELECT STATEMENT -- encrypt the password and MATCH
        $sql = "SELECT Maintainer_ID,MaintainerEmail,CONCAT(MaintainerFirstName,' ',MaintainerLastName) AS Name FROM Maintainers 
        WHERE MaintainerEmail = '$clean_userEmail' and MaintainertPassword = password('$clean_userPassWord')";
        // mysqli_query(connection,query,resultmode); performs a query against the database.
        $result = mysqli_query($conn,$sql);
        // if the record exists in DB
        if (mysqli_num_rows($result) > 0) {
            // start the session
           // session_start();
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // assign these variables to the GLOBAL Session
                // do not display in this function
                $_SESSION['Maintainer_ID'] = $row["Maintainer_ID"]; 
                $_SESSION['MaintainerEmail'] = $row["MaintainerEmail"]; 
                $_SESSION['MaintName'] = $row["Name"];  
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
        require("../../Tenants_variables/maint_dbconnect.php"); 
       // session_start();
        $maint_ID = $_SESSION['Maintainer_ID'];
        // echo  $maint_ID; 
        // statment 
        $sql = "SELECT Sec1.secquest AS secQuest1,Sec2.secquest AS secQuest2, Sec3.secquest AS secQuest3  
        FROM MaintainerProfiles
        JOIN TenantSecQuestions Sec1 ON MaintainerProfiles.MaintainerSecQues1_FK = Sec1.secQues_ID
        JOIN TenantSecQuestions Sec2 ON MaintainerProfiles.MaintainerSecQues2_FK = Sec2.secQues_ID
        JOIN TenantSecQuestions Sec3 ON MaintainerProfiles.MaintainerSecQues3_FK = Sec3.secQues_ID
        WHERE  Maintainer_FK = '$maint_ID'";
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
            echo "<form name='valSecAnswer' method='post' action='maintainerValidateAnswer.php'>";
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
        // parameters are already sanitized at this point
        // get the logged in user ID from DB
        // Stored in the GLOBAL SESSION
        session_start();
        $maint_ID = $_SESSION['Maintainer_ID'];
        // connect to database
        require("../../Tenants_variables/maint_dbconnect.php");
        $clean_secretAnswer = mysqli_real_escape_string($conn,$secretAnswer);
        //SQL SELECT STATEMENT -- Check the 3 answers
        $sql = "SELECT MaintainerProfile_ID,MaintainerSecAns1,MaintainerSecAns2,MaintainerSecAns3 
        FROM MaintainerProfiles WHERE MaintainerProfile_ID = '$maint_ID' 
        AND MaintainerSecAns1 = password('$clean_secretAnswer') OR MaintainerSecAns2 = password('$clean_secretAnswer') OR MaintainerSecAns3 = password('$clean_secretAnswer')";
        // returned record
        $result = mysqli_query($conn,$sql);
        // if a record is returned
        if (mysqli_num_rows($result) > 0){
            echo "MATCh";
            // redirect to welcome page
            header("location: maintDash.php");
        } else {
            echo "answer does not Match";
            header("location: logout.php");
        }// if (mysqli_num_rows($result) > 0)	

    }// end validateTenantAnswer()



    // function displayUserProfile(){
    //     // get the logged in user ID from DB
    //     // Stored in the GLOBAL SESSION
    //     session_start();
    //     $tenantID = $_SESSION['TenantID'];
    //      // connect to database
    //     require("includes/dbconnect.php"); 
    //     //SQL SELECT STATEMENT 
    //     $sql = "SELECT TenantEmail,CONCAT(TenantFirstName,' ',TenantLastName) AS Name,TenantHomeNumber,TenantMobileNumber,
    //     TenantWorkNumber,addr.Apt_street AS addr,city.Apt_City AS city,t_state.Apt_State AS t_state,zip.Apt_Zip AS zip,aptNum.Apt_number AS aptnum
    //     FROM Tenants 
    //     JOIN Apartments addr ON Tenants.TenantAddress_FK = addr.Apartment_ID
    //     JOIN Apartments city ON Tenants.TenantCity_FK = city.Apartment_ID
    //     JOIN Apartments t_state ON Tenants.TenantState_FK = t_state.Apartment_ID
    //     JOIN Apartments zip ON Tenants.TenantZip_FK = zip.Apartment_ID
    //     JOIN Apartments aptNum ON Tenants.TenantAptNum_FK = aptNum.Apartment_ID
    //     WHERE Tenant_ID = '$tenantID'";
    //             // mysqli_query(connection,query,resultmode); performs a query against the database.
    //      $result = mysqli_query($conn,$sql);
    //     // if the record exists in DB
    //     if (mysqli_num_rows($result) > 0) {

    //         // output data of each row
    //         while($row = mysqli_fetch_assoc($result)) {
    //             // assign these variables to the GLOBAL Session
    //             // do not display in this function
    //             echo $row["Name"]."<br>"; 
    //             echo $row["TenantEmail"]."<br>"; 
    //             echo $row["TenantHomeNumber"]."<br>"; 
    //             echo $row["TenantMobileNumber"]."<br>"; 
    //             echo $row["TenantWorkNumber"]."<br>"; 
    //             echo $row["addr"]."<br>"; 
    //             echo $row["city"]."<br>"; 
    //             echo $row["t_state"]."<br>";

    //             echo $row["zip"]."<br>"; 
    //             echo $row["aptnum"]."<br>";

    //         } // end while($row = mysqli_fetch_assoc($result))
    //         } else {
    //             // user is NOT in the database table
    //             $error = "cant find infor check your sql";
    //             /////////////////////////////////////////////////////////////////////////////
    //             echo "<h1>".$error."</h1>";
    //             // exit out of the functions or everything else witll continue to run
    //             exit();
    //         } // end if (mysqli_num_rows($result) > 0)
    //     // close the DB connection
    //     mysqli_close($conn);
    // }// end displayUserProfile

?>