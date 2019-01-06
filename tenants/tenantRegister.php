<?php

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
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
				<!-- Brand/logo -->
				<a class="navbar-brand" href="#">Tenant Portal</a>
				<!-- Links -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
					<a class="nav-link" href="tenantRegister.php"><ion-icon name="person-add"></ion-icon>&nbsp Register</a>
					</li>
				</ul>
			</nav>
			<div class="container-fluid">
				<h3>Tenant Portal Application</h3>
				<p>Tenant Registration Form</p>
			</div>
		<main>
			<!-- Container for the Form-->
			<div class="container">
				<h3>Tenent Personal Information</h3>
				
				<!-- create the loggin form with an input text boxes -->
				<form name="login" method="post" action="insertNewUser.php"> 
					<!--The Login form should consist of fields for username, email address and a password. -->
					<div class="form-group">
						First Name:<input type="text" class="form-control" placeholder="Enter your first name" name="fName" required>
					</div>
					<div class="form-group">
						Last Name:<input type="text" class="form-control" placeholder="Enter your last name" name="lName" required>
					</div>

					<div class="form-group">
						Apartment:<select class="form-control" name="apt" required>
						<!-- Questions-->
						<?php apartments(); ?>
					</div>








					<div class="form-group">
						Home Telephone:<input type="text" class="form-control" placeholder="123-456-7890" name="hPhone"
						pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$">
					</div>
					<div class="form-group">
						Mobile Telephone:<input type="text" class="form-control" placeholder="123-456-7890" name="mPhone"
						pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$">	
					</div>
				
					<div class="form-group">
						Work Telephone:<input type="text" class="form-control"placeholder="123-456-7890" name="wPhone"
						pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$">
					</div>

					<div class="form-group">
						E-mail:<input type="email" class="form-control" placeholder="somename@mail.com" name="email" required>
					</div>

					<hr>
					<h3>Tenent Log-in Information</h3>
					<p>Password must contain the following: <strong>1 upper case letter, 1 number and 1 special character
					and at least 8 characters in length</strong></p>
					<div class="form-group">
						Password:<input type="password" class="form-control" placeholder="Enter Password" name="userPassWord" 
						pattern="(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}" required>
					</div>
					<hr>
					<div class="form-group">
						Security Question:<select class="form-control" name="secquest1" required>
						<!-- Questions-->
						<?php registerQuestions(); ?>
					</div>
					<div class="form-group">
						Answer:<input class="form-control" type="text" placeholder="Enter Answer" name="secanwser1" required>
					</div>
					<hr>
					<div class="form-group">
						Security Question:<select class="form-control" name="secquest2" required>
						<!-- Questions-->
						<?php registerQuestions(); ?>
					</div>
					<div class="form-group">
						Answer:<input class="form-control" type="text" placeholder="Enter Answer" name="secanwser2" required>
					</div>
					<hr>
					<div class="form-group">
						Security Question:<select class="form-control" name="secquest3" required>
						<!-- Questions-->
						<?php registerQuestions(); ?>
					</div>
					<div class="form-group">
						Answer:<input class="form-control" type="text" placeholder="Enter Answer" name="secanwser3" required>
					</div>
					<hr>
					<div class="form-group">
						<button class="btn btn-primary" name="registerBtn" type="submit">Register</button>
						<a href="index.html" class=""><button class="btn btn-danger">&nbsp Cancel &nbsp</button></a>
					</div>
				</form>
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
