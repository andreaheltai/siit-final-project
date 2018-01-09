<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Course Notes - Scoala Informala de IT</title>

    <!-- Bootstrap core CSS -->
    <link href="ui/assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="ui/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="ui/assets/css/clean-blog.css" rel="stylesheet">
    
    <!-- Custom styles for this website -->
    <link href="ui/assets/css/style.css" rel="stylesheet" type='text/css'>

    <!-- Temporary navbar container fix -->
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    </style>

</head>

<body>
    
    <!-- Navbar & Page Header -->
    <?php include ("layouts/navbar-header.php"); ?>
    
    <!-- Search Box -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search" id="srch-term">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- End of Search Box -->

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1" >
                <div id="message">
                </div>
                <!-- Pager -->
                <div class="clearfix" id="pagination">
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <?php include ("layouts/footer.php"); ?>
    
    <!-- Custom Javascript for page -->
    <script src="ui/assets/js/Modules/articlesModule.js"></script>
    <script src="ui/assets/js/uiModules/articlesUiModule.js"></script>
    <script src="ui/assets/js/queries.js"></script>
    <script src="ui/assets/js/home.js"></script>
    

</body>

</html>
