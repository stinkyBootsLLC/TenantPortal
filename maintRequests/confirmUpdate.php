<html>
    <body>

        <?php 
        /**
         * Eduardo Estrada
         * 12/30/2018
         * maintPendingIssues.php
         * Purpose:
         * To update the maint issue in the database
         * Modification - 3/8/2019
         * Trying to fix problem - with empty fields - only on the aws infastructure
         */

            include("../utilities/utility.php");
            // grab all the POST DATA
            /*@TODO Sanitize this data*/ 
            $issueID = sanatizeData($_POST["id"]); 
            $reportDate = sanatizeData($_POST["IssueReportDate"]);  
            $priority = sanatizeData($_POST["IssuePriority"]); 
            $status = sanatizeData($_POST["IssueStatus"]); 
            $description = sanatizeData($_POST["IssueDescription"]); 
            $solution = sanatizeData($_POST["IssueSolution"]); 
            $repairDate = sanatizeData($_POST["IssueRepairDate"]); 
            $scheduleDate = sanatizeData($_POST["ScheduledDate"]);  
            $price = sanatizeData($_POST["IssueRepairPrice"]); 
            $name = sanatizeData($_POST["tenantName"]); 
            $aptNumber = sanatizeData($_POST["aptNumber"]); 

            session_start();
            // user session MUST be SET
            if(isset($_SESSION['app_userEmail']) && isset($_SESSION['app_pass'])){
                // connect to database
                require("../../Tenants_variables/maint_dbconnect.php");
                // from open to pending update
                if($status == "pending"){

                    $sql = "UPDATE TenantMaintIssues SET IssuePriority='$priority',IssueStatus='$status',ScheduledDate='$scheduleDate'
                    WHERE TenantMaintIssue_ID=$issueID ";
            
                    if (mysqli_query($conn, $sql)) {
                        echo "Record updated successfully";
                        header("Refresh:3; url=../maintainers/maintDash.php");
                    } else {
                        //echo "Error updating record: " . mysqli_error($conn);
                        echo "<h2>Priority, and Scheduled Date Cannot be blank</h2>";
                        echo "<p>When updating an issue from open - pending<br/>";
                        echo "Priority, and Scheduled Date fields cannot be blank</p>";
                    } // end (mysqli_query($conn, $sql))
                // from pending to closed OR from open to closed
                } else if ($status == "closed"){
                        // everything must be filled out
                        $sqlCL = "UPDATE TenantMaintIssues SET IssuePriority='$priority',IssueStatus='$status', IssueSolution='$solution',
                        IssueRepairDate='$repairDate',ScheduledDate='$scheduleDate',IssueRepairPrice='$price'
                        WHERE TenantMaintIssue_ID=$issueID ";
                
                        if (mysqli_query($conn, $sqlCL)) {
                            echo "Record updated successfully";
                            header("Refresh:3; url=../maintainers/maintDash.php");
                        } else {
                            echo "<h2>Closed Issues - Must completely fill out form</h2>"; 
                            echo "<p>When updating an issue from open - closed OR pending - closed<br/>";
                            echo "Must completely fill out form</p>";
                            //echo "Error updating record: " . mysqli_error($conn);
                        } // end (mysqli_query($conn, $sql))

                } else {
                    echo "<h2>Status must be PENDING or CLOSED</h2>"; 
                }// end if ($status == "closed")

            } else { 
                echo "<h5>User Is Not Logged-In</h5>"; 
            } // end if(isset($_SESSION['app_userEmail']) && isset($_SESSION['app_pass']))

        ?>
    </body>
</html>
