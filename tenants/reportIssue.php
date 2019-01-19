<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <title>Tenant Portal 2019</title>
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
                <a class="nav-link" href="#">Tenant Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><ion-icon name="person"></ion-icon>&nbspMy Profile</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php"><ion-icon name="power"></ion-icon>&nbsp Log-Out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <h3>Tenant Portal Application (BETA VER.1.0)</h3>
        <p>Report Maintenace issue</p>
    </div>
    <main>  
        <div class="container">
            <div class="shadow p-3 mb-5 bg-white rounded"> 
                <form action='confirmReport.php' method='POST'>
                    <div class='form-group'>
                        <?php 
                            $today = date("Y-m-d");
                            echo "Reported:<input type='date' class='form-control' id='IssueReportDate' name='IssueReportDate' 
                            value=".$today." readonly>";
                        ?>
                    </div>
                    <div class='form-group'>
                        <label for='Description'>Description:</label>
                        <textarea  class='form-control' name='IssueDescription'rows='2' cols='33' id='Description' 
                        placeholder="Describe the problem here..."></textarea>
                    </div> 
                    <input class='btn btn-success' type='submit' value='Report'>
                    <a id="formButton" href="tenantDash.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </main>  
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
		<!--===== END FOOTER =============-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
</body>
</html>