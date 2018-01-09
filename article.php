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

    <title>Article</title>

    <!-- Bootstrap core CSS -->
    <link href="ui/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="ui/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="ui/assets/css/clean-blog.css" rel="stylesheet" type="text/css">
    
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

    <!-- Delete & Edit buttons -->
    <?php
        if (!isset($_SESSION["role"])) {
             $adminPanel = '<div></div>';
        } else if (($_SESSION["role"] === "guest") || ($_SESSION["role"] === "user")){
            $adminPanel = '<div></div>';
        } else if ($_SESSION["role"] === "admin"){
            $adminPanel = '<div class="container admin" id="admin-btns">
                          </div>';    
        } else {
            $adminPanel = '<div></div>';
        }
        
        echo $adminPanel;
    ?>
    
    <!-- Article Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div id="message">
                    </div>
                    <div id="displayArt">
                    </div>
                </div>
            </div>
            <hr>
            <!--Add comments -->
            
            <div class="row comm" style="display: none">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <?php
                        if (!isset($_SESSION['role'])) {
                            $commTitle = '<h5>Please <a href="signup.php">sign up </a> or <a href="login.php">log in</a> to leave a comment.';
                        } else if (($_SESSION['role'] === 'admin') || ($_SESSION['role'] === 'guest') || ($_SESSION['role']==='user')) {
                            $commTitle = '<h5>Comments</h5>';
                        } else {
                            $commTitle = '<h5>Please <a href="signup.php">sign up </a> to leave a comment.';
                        }
                        echo $commTitle;
                    ?>
                    <div class = "col-sm-8" id="commErr">
                    </div>
                    <?php
                        if (!isset($_SESSION['role'])) {
                            $addComm = '';
                        } else if (($_SESSION['role'] === 'admin') || ($_SESSION['role'] === 'guest') || ($_SESSION['role']==='user')) {
                            $addComm = '<div class = "col-sm-8">
                                        <form method="post" class="form" role="form" id="addComm">
                                            <div class="form-group">
                                                <input class="form-control checkComm text" type="text" name="title" placeholder="Title" id="rad1" />
                                                <textarea rows="5" class="form-control checkComm text" type="text" name="content" placeholder="Comment" id="rad2"></textarea>
                                                <input type="hidden" class="form-control checkComm" name="user_id" value = '. $_SESSION['user_id'] . ' />
                                                <input type="hidden" class="form-control checkComm" name="status" value="published" />
                                                <input type="hidden" class="form-control checkComm" name="article_id" id="commArtId"/>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-default" id="addComm-btn">Add</button>
                                            </div>
                                        </form>
                                        </div>';
                        } else {
                            $addComm = '';
                        }
                        echo $addComm;
                    ?>
                </div>
            </div>
            <!-- Get comments -->
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1" id="commSection">
                </div>
            </div>
            <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1" id="commSection">
                <!--Comm starts here-->
            </div>
        </div>
            
        <!-- End of comments -->
        </div>
    </article>

    <hr>

    <!-- Footer -->
    <?php include ("layouts/footer.php"); ?>
    
    <!-- Custom Javascript for page -->
    <script src="ui/assets/js/Modules/articlesModule.js"></script>
    <script src="ui/assets/js/uiModules/commentsUiModule.js"></script>
    <script src="ui/assets/js/uiModules/articlesUiModule.js"></script>
    <script src="ui/assets/js/Modules/commentsModule.js"></script>
    <script src="ui/assets/js/queries.js"></script>
    <script src="ui/assets/js/article.js"></script>


</body>

</html>
