<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

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
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php"><ion-icon name="power"></ion-icon>&nbsp Log-Out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <h3>Tenant Portal Application</h3>
        <p>Closed Maintenace issue history</p>
    </div>







    <div class="container">

        <?php 
            /**
             * Eduardo Estrada
             * 12/28/2018
             * maintClosedIssues.php
             * Purpose:
             * To display the open and Pending issues to the Landlord and Maintenace
             */

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
            $sql = "SELECT IssueReportDate,IssuePriority,IssueStatus,IssueDescription,IssueSolution,IssueRepairDate,ScheduledDate,
            IssueRepairPrice,CONCAT(tenantFname.TenantFirstName,' ',tenantLname.TenantLastName) AS Name,
            tenantApt.Apt_number AS aptNumber
            FROM TenantMaintIssues 
            JOIN Tenants tenantFname ON TenantMaintIssues.Tenant_FK = tenantFname.Tenant_ID
            JOIN Tenants tenantLname ON TenantMaintIssues.Tenant_FK = tenantLname.Tenant_ID
            JOIN Apartments tenantApt ON TenantMaintIssues.Tenant_Apt_FK = tenantApt.Apartment_ID
            WHERE IssueStatus='closed'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // make the table
                echo "<table class='table table-bordered'>";
                echo "<thead class='thead-dark'>";
                echo "<tr>";
                echo "<th scope='col'>Reported Date</th>";
                echo "<th scope='col'>Priority</th> ";
                echo "<th scope='col'>Status</th>";
                echo "<th scope='col'>Description</th>";
                echo "<th scope='col'>Solution</th>"; 
                echo "<th scope='col'>Repair Date</th>";
                echo "<th scope='col'>Scheduled Date</th>";
                echo "<th scope='col'>Repair Price</th>";
                echo "<th scope='col'>Tenant</th>"; 
                echo "<th scope='col'>APT NUM</th>";
                echo "</tr>";
                echo "</thead>";
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row["IssueReportDate"]."</td>"; 
                    echo "<td>".$row["IssuePriority"]. "</td>"; 
                    echo "<td>".$row["IssueStatus"].  "</td>"; 
                    echo "<td>".$row["IssueDescription"]."</td>"; 
                    echo "<td>".$row["IssueSolution"]."</td>"; 
                    echo "<td>".$row["IssueRepairDate"]."</td>";  
                    echo "<td>".$row["ScheduledDate"]."</td>"; 
                    echo "<td>".$row["IssueRepairPrice"]."</td>"; 
                    echo "<td>".$row["Name"]."</td>"; 
                    echo "<td>".$row["aptNumber"]."</td>";       
                } // end while($row = mysqli_fetch_assoc($result))
                echo "</table>"; // close the table
            } else {
                echo "0 closed results found";
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