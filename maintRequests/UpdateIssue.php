<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Font-Awsome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" 
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" 
    crossorigin="anonymous">
    <title>Tenant Portal 2019</title>
    <meta name="author" content="Eduardo Estrada">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
    <!-- CSS home made sources-->
    <link rel="stylesheet" href="../assets/css/tenants.css">
    <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
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
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php"><ion-icon name="power"></ion-icon>&nbsp Log-Out</a>
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
             * UpdateIssues.php
             * Purpose:
             * To update the maint issue by ID
             */
            include("../utilities/utility.php");
                // get the the id
                $issueID = sanatizeData($_GET["id"]); 

                // connect to the database
                require("../../Tenants_variables/maint_dbconnect.php");
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
             
                echo "<option value='pending'>pending</option>";
                echo "<option value='closed'>closed</option>";
                echo "</select><br>"; 
                echo "</fieldset>";
                echo "</div>";
                // description field
                echo "<div class='form-group'>";
                echo "<label for='Description'>Description:</label>";
                echo "<textarea  class='form-control' name='IssueDescription'rows='2' cols='33' id='Description' readonly>".$IssueDescription."</textarea>";
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

    <!--==== FOOTER  Bootstrap 4 Class  Footer-Dark.css =======-->
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 item">
                        <h2>Other Links</h2>
                        <ul>
                            <li><a href="#" alt="">link</a></li>
                            <li><a href="#" alt="">link</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item">
                        <h2>About</h2>
                        <ul>
                            <li><a href="#">Purpose</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 item text">
                        <h2>Main Site Title</h2>
                        <p> sub paragraph</p>
                        <img src="assets/img/logo.png" alt="" width="155">
                    </div>
                    <!-- Bottom Footer Icons -->
                    <div class="col item social"> 
                        <a href="#"><i class="fab fa-facebook-square"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>	
                </div> <!-- end row -->
                <p class="copyright">StinkyBoots Studio 2018</p>
            </div>
        </footer>
    </div> <!-- end <div class="footer-dark">-->
    <!--===== END FOOTER =============-->\
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
</body>
</html>