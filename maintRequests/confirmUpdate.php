<html>
<body>

<?php 
/**
 * Eduardo Estrada
 * 12/30/2018
 * maintPendingIssues.php
 * Purpose:
 * To update the maint issue in the database
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

        $sql = "UPDATE TenantMaintIssues SET IssuePriority='$priority',IssueStatus='$status', IssueSolution='$solution',
        IssueRepairDate='$repairDate',ScheduledDate='$scheduleDate',IssueRepairPrice='$price'
        WHERE TenantMaintIssue_ID=$issueID ";

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        
            header("Refresh:3; url=../maintainers/maintDash.php");
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    mysqli_close($conn);
    else { 
        echo "<h5>User Is Not Logged-In</h5>"; 
    }

?>


</body>
</html>
