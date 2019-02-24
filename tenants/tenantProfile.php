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
                <a class="nav-link" href="tenantDash.php"><ion-icon name="home"></ion-icon>&nbsp Tenant Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tenantProfile.php"><ion-icon name="person"></ion-icon>&nbsp My Profile</a>
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
        <p>Tenant Profile</p>
    </div> 
    <main>
    <div class="container">
        <!--Tenant Profile display here-->
        <?php 
            include("includes/tenantFunctions.php");
            include("../utilities/utility.php");
            displayUserProfile();    
        ?>
    </div>

    </main>
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
    <!-- Reload JavaScript -->
    <script>
    // Reload page every 30 minutes
    setTimeout(function(){
    window.location.reload(1);
    }, 1800000);
    </script>
</body>
</html>