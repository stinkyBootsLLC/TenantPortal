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
        <p>Open Maintenace issues </p>
    </div> 
    <div class="container">
 
        <?php 
            /**
             * Eduardo Estrada
             * 12/28/2018
             * maintOpenIssues.php
             * Purpose:
             * To display the open issues to the Landlord and Maintenace
             */
            session_start();
            // user session MUST be SET
            if(isset($_SESSION['app_userEmail']) && isset($_SESSION['app_pass'])){
                // connect to the database
                require("../../Tenants_variables/maint_dbconnect.php");
                // select and display everything in the TenantMaintIssues Table
                $sql = "SELECT TenantMaintIssue_ID AS ID,IssueReportDate,IssuePriority,IssueStatus,IssueDescription,IssueSolution,IssueRepairDate,ScheduledDate,
                CONCAT(tenantFname.TenantFirstName,' ',tenantLname.TenantLastName) AS Name,
                tenantApt.Apt_number AS aptNumber
                FROM TenantMaintIssues 
                JOIN Tenants tenantFname ON TenantMaintIssues.Tenant_FK = tenantFname.Tenant_ID
                JOIN Tenants tenantLname ON TenantMaintIssues.Tenant_FK = tenantLname.Tenant_ID
                JOIN Apartments tenantApt ON TenantMaintIssues.Tenant_Apt_FK = tenantApt.Apartment_ID
                WHERE IssueStatus='open' ORDER BY IssueReportDate ASC";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    
                    // make the table
                    echo "<table class='table table-bordered'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Reported Date</th>";
                    echo "<th>Status</th>";
                    echo "<th>Description</th>";
                    echo "<th>Tenant</th>"; 
                    echo "<th>APT NUM</th>";
                    echo "<th>Update</th>";
                    echo "</tr>";
                
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<form action='UpdateIssue.php' method='GET'>";
                        echo "<td><input type='text' name='id' value=".$row['ID']." readonly></td>";
                        echo "<td>".$row["IssueReportDate"]."</td>"; 
                        echo "<td>".$row["IssueStatus"].  "</td>"; 
                        echo "<td>".$row["IssueDescription"]."</td>"; 
                        echo "<td>".$row["Name"]."</td>"; 
                        echo "<td>".$row["aptNumber"]."</td>";  
                        echo "<td> <input type='submit' value='UPDATE'></td>"; 
                        echo "</form>"; 
                        echo "</tr>";   
                    } // end while  ($row = mysqli_fetch_assoc($result))
                    echo "</table>"; // close the table  
                } else {
                    echo "0 Open issues found";
                } // end if (mysqli_num_rows($result) > 0)

                // close the DB connection
                mysqli_close($conn);
            } else { 
                echo "<h5>User Is Not Logged-In</h5>"; 
            }// end if(isset($_SESSION['app_userEmail']) && isset($_SESSION['app_pass']))
        ?>

    </div> 

    <!--==== FOOTER  Bootstrap 4 Class  Footer-Dark.css =======-->
    <div id="wrapper">
        <div id="footer">
            <footer class="footer footer-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 item">
                            <h2>Other Links</h2>
                            <ul>
                                <li><a href="https://www.umuc.edu/" alt="">UMUC</a></li>
                                <li><a href="https://www.computer.org/" alt="">IEEE CS</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3 item">
                            <h2>About</h2>
                            <ul>
                                <li><a href="#">Purpose</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 item text">
                            <h2>Tenant Portal Web Application</h2>
                            <p>Prototype - tenant / landlord maintenance issue reporting system</p>
                            
                        </div>
                        <!-- Bottom Footer Icons -->
                        <div class="col item social"> 
                            <a href="https://play.google.com/store/search?q=stinkybootsllc&c=apps"><i class="fab fa-android fa-2x"></i></a>
                            <a href="https://github.com/stinkybootsllc"><i class="fab fa-github fa-2x"></i></a>
                            <a href="https://www.linkedin.com/in/eduardo-estrada-b8744017a/"><i class="fab fa-linkedin fa-2x"></i></a>
                        </div>
                    </div> <!-- end row -->
                    <p class="copyright">StinkyBoots Studio 2018</p>
                </div>
            </footer><!-- end <div class="footer-dark">-->
        </div><!-- end <div id="footer">-->
    </div><!-- end <div id="wrapper">-->
    <!--===== END FOOTER =============-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
</body>
</html>