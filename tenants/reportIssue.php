<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <title>Tenant Portal 2019</title>

        <style>
            body {background-color: rgb(234, 234, 225);}

        
        </style>



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
                    echo "Reported:<input type='date' class='form-control' id='IssueReportDate' name='IssueReportDate' value=".$today." readonly>";
                ?>
            </div>
           

            <div class='form-group'>
            <label for='Description'>Description:</label>
            <textarea  class='form-control' name='IssueDescription'rows='2' cols='33' id='Description' placeholder="Describe the problem here..."></textarea>
            </div> 


            <div class='form-group'>
            <label for='Tenant Name'>Tenant Name:</label>
            <input type='text' class='form-control' name='tenantName' id='Tenant Name' value=" "><br>
            </div>
            <div class='form-group'>
            <label for='TenantApt'>Tenant Apt Number:</label>
            <input type='text'  class='form-control' name='aptNumber' id='TenantApt' value=" "><br>
            </div>

            <input class='btn btn-success' type='submit' value='Report'>
            <a id="formButton" href="tenantDash.php" class="btn btn-danger">Cancel</a>


        </form>

        </div>
     
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