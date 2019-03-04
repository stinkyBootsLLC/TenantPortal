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
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../tenants/tenantRegister.php"><ion-icon name="person-add"></ion-icon>&nbsp Register</a>
                    </li>
                </ul>
            </div>
		</nav>
        <div class="container-fluid">
            <h3>Tenant Portal Application (BETA VER.1.0)</h3>
            <p>Random User Security Question Validation</p>
        </div>
        <main> 
        <div class="container">
            <?php
                include("includes/maintainerFunctions.php");
                include("../utilities/utility.php");
                // Retrieve and sanatize Post Data
                $userEmail= sanatizeData($_POST["userEmail"]); 
                $userPassWord = sanatizeData($_POST["userPassWord"]); 
                // protect blank empty entries
                if (!empty($userEmail) && !empty($userPassWord)) {
                // max session time
                ini_set('session.gc_maxlifetime', 1800000); //30 min
                // Set the session information  
                // PHP session default time = 30min
                session_start();
                $_SESSION['app_userEmail'] = sanatizeData($userEmail); 
                $_SESSION['app_pass'] = sanatizeData($userPassWord);
               
                $_SESSION['start_activity'] = time();

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    // call function and pass variables
                    selectMaintInfo($userEmail, $userPassWord);

                }// end if($_SERVER["REQUEST_METHOD"] == "POST")
                } else {
                    // redirect to error
                    header("Location: error.php");
                    // kill the application
                    die();
                }// end  if (!empty($userEmail)) 
                
            ?>
        </div>
        </main>  
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
    </body>
</html>