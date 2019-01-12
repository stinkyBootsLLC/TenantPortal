<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

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
    </nav>

    <div class="container-fluid">
        <h3>Tenant Portal Application</h3>
        <p>Maintenace Dashboard</p>
    </div> 
    <div class="container">
    <div class="shadow p-3 mb-5 bg-white rounded">
    <div class="card w-100">
        <div class="card-body">
        <h5 class="card-title">Open Maint Issues</h5>
        <p class="card-text">Recently added tenant maintenance issues.</p>
        <a href="../maintRequests/maintOpenIssues.php" class="btn btn-primary">Button</a>
        </div>
        </div>
    
    
    
    

    
    </div>
    <div class="shadow p-3 mb-5 bg-white rounded">
    <div class="card w-100">
        <div class="card-body">
        <h5 class="card-title">Pending Maint Issues</h5>
        <p class="card-text">Pending issues with scheduled repair dates.</p>
        <a href="../maintRequests/maintPendingIssues.php" class="btn btn-primary">Button</a>
        </div>
        </div>
   



    </div>
    <div class="shadow p-3 mb-5 bg-white rounded">

        <div class="card w-100">
        <div class="card-body">
        <h5 class="card-title">Closed Maint Issues</h5>
        <p class="card-text">Closed issue history.</p>
        <a href="../maintRequests/maintClosedIssues.php" class="btn btn-primary">Button</a>
        </div>
        </div>
   
    </div> 
    <div class="container">
        <?php 
         ?>
    </div> 



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>