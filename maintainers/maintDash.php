<?php 
    // max session time
    ini_set('session.gc_maxlifetime', 1800000); //30 min
    session_start();// start the session
	$mySession = date("H:i:s"); // current time        
?>
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
                    <a class="nav-link" href="maintDash.php"><ion-icon name="home"></ion-icon>&nbsp Maintenance Dashboard <span class="sr-only">(current)</span></a>
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
            <p>Maintenace Dashboard</p>
        </div> 

        <main>
            <div class="container">
                <?php
                    include("../utilities/utility.php");
                    include("includes/maintainerFunctions.php");
                    $startTime = $_SESSION['start_activity'];// capture the session start time
                    // Display the GLOBAL Session information
                    
                    echo"<div class='shadow p-3 mb-5 bg-white rounded'>";
                        echo"<div class='card w-100'>";
                            echo"<div class='card-body'>";
                                echo "<h2>Session Data</h2>";
                                // After login, a personal welcome message should appear
                                echo "<h3> Welcome Back- " .$_SESSION['app_userEmail']."<br>";
                                echo "<p><b>Current Time</b> = ".$mySession." <b>Session Start time</b> = ".date('H:i:s', $startTime)."</p>";
                                echo "<p>User will be logged out after 30 minutes</p>";
                            echo "</div>"; 
                        echo "</div>";
                    echo "</div";
                    // start to monitor the session
                    if(isset($_SESSION['app_userEmail'])){
                        // monitor the session
                        monitorSession();
                    }// endIf
                ?>
            </div>
            <div class="container">
            <?php $open = numberOfOpenIssues();$pending = numberOfPendingIssues(); $closed = numberOfClosedIssues();?>
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-sm-10">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title">Open Maint Issues [<?php  echo $open; ?>]</h5>
                                    <p class="card-text">Recently added tenant maintenance issues.</p>
                                    <a href="../maintRequests/maintOpenIssues.php" class="btn btn-primary">View Issues</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-10">
                    
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title">Pending Maint Issues [<?php  echo $pending; ?>]</h5>
                                    <p class="card-text">Pending issues with scheduled repair dates.</p>
                                    <a href="../maintRequests/maintPendingIssues.php" class="btn btn-primary">View Issues</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-10">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title">Closed Maint Issues [<?php  echo $closed; ?>]</h5>
                                    <p class="card-text">Closed issues with completed repaired dates.</p>
                                    <a href="../maintRequests/maintClosedIssues.php" class="btn btn-primary">View Issues</a>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div><!--end class="row"-->


                <!-- New Row-->
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-sm-10">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title">My Tenants</h5>
                                    <p class="card-text">Registered Tenants.</p>
                                    <a href="../maintRequests/myTenants.php" class="btn btn-primary">View Tenants</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- end my tenants card-->
                    <div class="col-lg-4 col-md-8 col-sm-10">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title">Empty Card</h5>
                                    <p class="card-text">Empty Card.</p>
                                    <a href="#" class="btn btn-primary">Button</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-10">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title">Empty Card</h5>
                                    <p class="card-text">Empty Card</p>
                                    <a href="#" class="btn btn-primary">Button</a>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div><!--end class="row"-->


            </div> <!--end class="container"-->


            













































        </main>
        <div class="top-spacing"></div>
        <div class="top-spacing"></div>
        <div class="top-spacing"></div>
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

        <!-- Reload JavaScript -->
        <script>
            // Reload page every 30 minutes
            setTimeout(function(){
                window.location.reload(1);
            }, 1800000);
        </script>
    </body>
</html>