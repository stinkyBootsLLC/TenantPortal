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
        <!-- Top Nav Bar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Tenant Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../maintainers/maintDash.php"><ion-icon name="home"></ion-icon>&nbsp Maintenance Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../maintRequests/maintOpenIssues.php"><ion-icon name="grid"></ion-icon>&nbsp Open Issues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../maintRequests/maintPendingIssues.php"><ion-icon name="grid"></ion-icon>&nbsp Pending Issues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../maintRequests/maintClosedIssues.php"><ion-icon name="grid"></ion-icon>&nbsp Closed Issues</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../maintRequests/myTenants.php"><ion-icon name="contacts"></ion-icon>&nbsp My Tenants</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php"><ion-icon name="power"></ion-icon>&nbsp Log-Out</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Top Nav Bar -->
        <div class="top-spacing"></div>
        <div class="container-fluid">
            <h3>Tenant Portal Application</h3>
            <p>My Registered Tenants (Card View)</p>
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
                include("../utilities/utility.php");
                session_start();
                // user session MUST be SET
                if(isset($_SESSION['app_userEmail']) && isset($_SESSION['app_pass'])){
                    // monitor the session
                    monitorSession();
                    // connect to the database
                    require("../../Tenants_variables/maint_dbconnect.php");

                    $sql ="SELECT TenantEmail AS email, CONCAT(TenantFirstName,' ',TenantLastName) AS name, TenantHomeNumber, TenantMobileNumber, 
                    TenantWorkNumber, tenantApt.Apt_number AS aptNumber, tenantCity.Apt_City AS aptCity FROM Tenants
                    JOIN Apartments tenantApt ON Tenants.TenantAptNum_FK = tenantApt.Apartment_ID 
                    JOIN Apartments tenantCity ON Tenants.TenantCity_FK = tenantCity.Apartment_ID";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            // Tenanat Information card
                            echo "<div class='shadow p-3 mb-5 bg-white rounded'>"; 
                            echo "<div class='card w-100'>"; 
                            echo "<div class='card-body'>"; 
                            echo "<h5 class='card-title'>".$row["name"]."</h5>"; 
                            echo "<p class='card-text'><a href= 'mailto:".$row["email"]."'>".$row["email"]."</a></p>"; 
                            echo "<p class='card-text'><b>Apt Number = </b>".$row["aptNumber"]."</p>"; 
                            echo "<p class='card-text'><b>City = </b>".$row["aptCity"]."</p>";
                            echo "<p class='card-text'><b>Home Number = </b>".$row["TenantHomeNumber"]."</p>"; 
                            echo "<p class='card-text'><b>Mobile Number = </b>".$row["TenantMobileNumber"]."</p>"; 
                            echo "<p class='card-text'><b>Work Number = </b>".$row["TenantWorkNumber"]."</p>";
                            echo "</div>"; 
                            echo "</div>"; 
                            echo "</div>"; 
                        } // end while  ($row = mysqli_fetch_assoc($result))
                        // echo "</table>"; // close the table  
                    } else {
                        echo "0 Tenants found";
                    } // end if (mysqli_num_rows($result) > 0)

                    // close the DB connection
                    mysqli_close($conn);
                } else { 
                    echo "<h5>User Is Not Logged-In</h5>"; 
                }// end if(isset($_SESSION['app_userEmail']) && isset($_SESSION['app_pass']))
            ?>

        </div> 
        <div class="top-spacing"></div>

        <!--==== FOOTER  Bootstrap 4 Class  Footer-Dark.css =======-->
        <div id="wrapper">
            <div id="footer">
                <footer class="footer footer-dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 item">
                                <h2>Payment</h2>
                                <ul>
                                    <li><a href="https://www.paypal.com/us/home" alt="">PayPal</a></li>
                                    <li><a href="https://venmo.com/" alt="">Venmo</a></li>
                                    <li><a href="https://www.payyourrent.com/sys/login/" alt="">PayYourRent</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 item">
                                <h2>About</h2>
                                <ul>
                                <li><a href="about.html">Purpose</a></li>
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
        <!-- Reload JavaScript -->
        <script>
            // Reload page every 30 minutes
            setTimeout(function(){
                window.location.reload(1);
            }, 1800000);
        </script>
    </body>
</html>