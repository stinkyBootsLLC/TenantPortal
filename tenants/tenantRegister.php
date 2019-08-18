<?php
// security ?s and session monitor fuction
// and apartment list function
require("../utilities/utility.php");
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
		<header></header>
		<!-- Top Nav Bar -->
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand" href="index.html">Tenant Portal</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="tenantRegister.php"><ion-icon name="person-add"></ion-icon>&nbsp Register</a>
					</li>
				</ul>
			</div>
		</nav>
		<!-- Top Nav Bar -->


			<div class="top-spacing"></div>	
		<div class="container-fluid">
			<h3>Tenant Portal Application</h3>
			<p>Tenant Registration Form</p>
		</div>
		<main>
			<!-- Container for the Form-->
			<div class="container">
				<h3>Tenent Personal Information</h3>
				
				<!-- create the loggin form with an input text boxes -->
				<form name="login" method="post" action="insertNewTenant.php "> 
					<!--The Login form should consist of fields for username, email address and a password. -->
					<div class="form-group">
						<label for="First-Name">First Name:</label>
						<input type="text" class="form-control" placeholder="Enter your first name" name="fName"  required>
					</div>
					<div class="form-group">
						<label for="Last-Name">Last Name:</label>
						<input type="text" class="form-control" placeholder="Enter your last name" name="lName"  required>
					</div>

					<div class="form-group">
						<label for="Apartment">Apartment:</label>
						<select class="form-control" name="apt"  required>
						<!-- Questions-->
						<?php apartments(); ?>
					</div>
					<div class="form-group">
						<label for="Home-Telephone"></label>Home Telephone:</label>
						<input type="text" class="form-control" placeholder="123-456-7890" name="hPhone"
						pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$" required>
					</div>
					<div class="form-group">
						<label for="Mobile-Telephone">Mobile Telephone:</label>
						<input type="text" class="form-control" placeholder="123-456-7890" name="mPhone"
						pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$">	
					</div>
				
					<div class="form-group">
						<label for="Work-Telephone">Work Telephone:</label>
						<input type="text" class="form-control"placeholder="123-456-7890" name="wPhone"
						pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$">
					</div>

					<div class="form-group">
						<label for="E-mail">E-mail:</label>
						<input type="email" class="form-control" placeholder="somename@mail.com" name="email"  required>
					</div>

					<hr>
					<h3>Tenent Log-in Information</h3>
					<p>Password must contain the following: <strong>1 upper case letter, 1 number and 1 special character
					and at least 8 characters in length</strong></p>
					<div class="form-group">
						<label for="Password">Password:</label>
						<input type="password" class="form-control" placeholder="Enter Password" name="userPassWord" id="userPassWord"
						pattern="(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}" 
						title="1 upper case letter, 1 number and 1 special character and at least 8 characters in length"  required>
					</div>
					<!--Needs to bee test 6/12/2019-->
					<div class="form-group">
							<label for="confirm-Password">Confirm Password:</label>
							<input type="password" class="form-control" placeholder="Re-type Password" name="conFirmUserPassWord" id="conFirmUserPassWord"
							pattern="(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}" 
							title="1 upper case letter, 1 number and 1 special character and at least 8 characters in length"  required>
							<span id='message'></span>
					</div>
					<hr>
					<div class="form-group">
						<label for="Security-Question-1">Security Question:</label>
						<select class="form-control" name="secquest1"  required>
						<!-- Questions-->
						<?php registerQuestions(); ?>
					</div>
					<div class="form-group">
						<label for="Answer-1">Answer:</label>
						<input class="form-control" type="text" placeholder="Enter Answer" name="secanwser1"  >
					</div>
					<hr>
					<div class="form-group">
						<label for="Security-Question-2">Security Question:</label>
						<select class="form-control" name="secquest2"  required>
						<!-- Questions-->
						<?php registerQuestions(); ?>
					</div>
					<div class="form-group">
						<label for="Answer-2">Answer:</label>
						<input class="form-control" type="text" placeholder="Enter Answer" name="secanwser2"  required>
					</div>
					<hr>
					<div class="form-group">
						<label for="Security-Question-3">Security Question:</label>
						<select class="form-control" name="secquest3"  required>
						<!-- Questions-->
						<?php registerQuestions(); ?>
					</div>
					<div class="form-group">
						<label for="Answer-3">Answer:</label>
						<input class="form-control" type="text" placeholder="Enter Answer" name="secanwser3"  required>
					</div>
					<hr>
					<div class="form-group">
						<button class="btn btn-primary" id="registerBtn" name="registerBtn" type="submit">Register</button>
						<a href="index.html" class=""><button class="btn btn-danger">&nbsp Cancel &nbsp</button></a>
					</div>
				</form>
			</div>
		</main>
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
		<script src="../assets/scripts/regis.js"></script>


	
	</body>
</html>
