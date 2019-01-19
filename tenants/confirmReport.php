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
        <p>Report Maintenace issue</p>
    </div>
 
    <div class="container">
 
        <?php 
            /**
             * Eduardo Estrada
             * 12/30/2018
             * reportIssues.php
             * Purpose:
             * To report the maint issue 
             */
            include("includes/tenantFunctions.php");
            include("../utilities/utility.php");
            // start the session
            session_start();
            // grab and sanitize all the POST DATA
            $reportDate = sanatizeData($_POST["IssueReportDate"]); 
            $description = sanatizeData($_POST["IssueDescription"]);
            $tenantName = sanatizeData($_SESSION["TenantAddress_FK"]); 
            $aptNumber = sanatizeData($_SESSION["TenantAddress_FK"]);
            // connect to database
            require("../../Tenants_variables/tenant_dbconnect.php");
            $sql = "INSERT INTO TenantMaintIssues (IssueReportDate, IssueStatus, IssueDescription, Tenant_FK, Tenant_Apt_FK)
            VALUES ('$reportDate', 'open','$description', '$tenantName','$aptNumber')";
            
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                // redirect back to dash
                header('Refresh: 2; URL = tenantDash.php');
            } else {
                echo "Error: contact admin -- ec-69";
                mysqli_close($conn);
            }
            
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