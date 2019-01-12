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


    // grab all the POST DATA
    /*@TODO Sanitize this data*/ 
    $issueID = $_POST["id"]; 
    $reportDate = $_POST["IssueReportDate"]; 
    $priority = $_POST["IssuePriority"];
    $status = $_POST["IssueStatus"];
    $description = $_POST["IssueDescription"];
    $solution = $_POST["IssueSolution"];
    $repairDate = $_POST["IssueRepairDate"];
    $scheduleDate = $_POST["ScheduledDate"]; 
    $price = $_POST["IssueRepairPrice"];
    $name = $_POST["tenantName"];
    $aptNumber = $_POST["aptNumber"];


    // connect to the database
    $servername = "localhost";
    $username = "tenant_owner";
    $password = "owner4TenantPortal";
    $dbname = "TenantPortal";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE TenantMaintIssues SET IssuePriority='$priority',IssueStatus='$status', IssueSolution='$solution',
    IssueRepairDate='$repairDate',ScheduledDate='$scheduleDate',IssueRepairPrice='$price'
    WHERE TenantMaintIssue_ID=$issueID ";


    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
       
        header("Refresh:3; url=maintDash.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);




?>


</body>
</html>
