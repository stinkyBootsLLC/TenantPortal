<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <title>Tenant Portal 2019</title>
    </head>
  <body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">Tenant Portal</a>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Open Issues</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pending Issues</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Closed Issues</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <h3>Tenant Portal Application</h3>
        <p>Update Maintenace issue</p>
    </div>
 
    <div class="container">
 
        <?php 
            /**
             * Eduardo Estrada
             * 12/30/2018
             * maintPendingIssues.php
             * Purpose:
             * To update the maint issue form
             */
                // get the the id
                $issueID = $_GET["id"]; 

                // connect to the database
                $servername = "localhost";
                $username = "tenant_owner";
                $password = "owner4TenantPortal";
                $dbname = "TenantPortal";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }
                // select and display everything in the TenantMaintIssues Table
                $sql = "SELECT TenantMaintIssue_ID AS ID,IssueReportDate,IssuePriority,IssueStatus,IssueDescription,IssueSolution,IssueRepairDate,
                ScheduledDate,IssueRepairPrice,CONCAT(tenantFname.TenantFirstName,' ',tenantLname.TenantLastName) AS Name,tenantApt.Apt_number AS aptNumber
                FROM TenantMaintIssues 
                JOIN Tenants tenantFname ON TenantMaintIssues.Tenant_FK = tenantFname.Tenant_ID
                JOIN Tenants tenantLname ON TenantMaintIssues.Tenant_FK = tenantLname.Tenant_ID
                JOIN Apartments tenantApt ON TenantMaintIssues.Tenant_Apt_FK = tenantApt.Apartment_ID
                WHERE TenantMaintIssue_ID ='$issueID'";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                // assign variables
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['ID'];
                    $IssueReportDate = $row['IssueReportDate'];
                    $IssuePriority = $row['IssuePriority'];
                    $IssueStatus = $row['IssueStatus'];
                    $IssueDescription = $row['IssueDescription'];
                    $IssueSolution = $row['IssueSolution'];
                    $IssueRepairDate = $row['IssueRepairDate'];
                    $ScheduledDate = $row['ScheduledDate'];
                    $IssueRepairPrice = $row['IssueRepairPrice'];
                    $tenantName = $row['Name'];
                    $aptNumber = $row['aptNumber'];

                }// end while($row = mysqli_fetch_assoc($result))
                // create the form
                echo "<form action='confirmUpdate.php' method='POST'>";
                echo "<div class='form-group'>";
                echo "<fieldset>";
                echo "<legend>Maint Issue:</legend>";
                echo "Issue ID:<input type='text' id='issueID' name='id' value=".$id." readonly>";
                echo "Reported:<input type='date'  id='IssueReportDate' name='IssueReportDate' value=".$IssueReportDate." readonly>";
                echo "Priority: <select name='IssuePriority'>";
                echo "<option value=".$IssuePriority.">".$IssuePriority."</option>";
                echo "<option value='High'>High</option>";
                echo "<option value='Medium'>Medium</option>";
                echo "<option value='Low'>Low</option>";
                echo "</select>"; 
                echo "Status: <select name='IssueStatus'>";
                echo "<option value=".$IssueStatus.">".$IssueStatus."</option>";
                echo "<option value='open'>open</option>";
                echo "<option value='pending'>pending</option>";
                echo "<option value='closed'>closed</option>";
                echo "</select><br>"; 
                echo "</fieldset>";
                echo "</div>";
                // description field
                echo "<div class='form-group'>";
                echo "<label for='Description'>Description:</label>";
                echo "<textarea  class='form-control' name='IssueDescription'rows='2' cols='33' id='Description'>".$IssueDescription."</textarea>";
                echo "</div> ";
                // solution field
                echo "<div class='form-group'>";
                echo "<label for='Solution'>Solution:</label>";
                echo "<textarea  class='form-control' name='IssueSolution'rows='2' cols='33' id='Solution'>".$IssueSolution."</textarea><br>";
                echo "</div> ";
                // update info fieldset
                echo "<div class='form-group'>";
                echo "<fieldset>";
                echo "<legend>Repair Info:</legend>";
                echo "Scheduled: <input type='date' name='ScheduledDate' value=".$ScheduledDate.">";
                echo "Repaired: <input type='date' name='IssueRepairDate' value=".$IssueRepairDate.">";
                echo "Repair Price: <input type='text' name='IssueRepairPrice' value=".$IssueRepairPrice."><br>";
                echo "</fieldset>";
                echo "</div>";
                // tenant name field
                echo "<div class='form-group'>";
                echo "<label for='Tenant Name'>Tenant Name:</label>";
                echo "<input type='text' class='form-control' name='tenantName' id='Tenant Name' value=".$tenantName." readonly><br>";
                echo "</div>";
                // tenant apt number field
                echo "<div class='form-group'>";
                echo "<label for='TenantApt'>Tenant Apt Number:</label>";
                echo "<input type='text'  class='form-control' name='aptNumber' id='TenantApt' value=".$aptNumber." readonly><br>";
                echo "</div>";
                // submit button
                echo "<input class='btn btn-primary' type='submit' value='UPDATE'>";
                echo "</form>";
                }else {
                    echo "Issue ID not found";
                } // end if (mysqli_num_rows($result) > 0)
                
                // close the DB connection
                mysqli_close($conn);
        ?>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>