<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: '.'home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add new article</title>

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

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <h1>Add new article</h1>
                <p></p>
                <form method="POST" name="createArt" id="createArtForm" enctype= multipart/form-data novalidate>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Title</label>
                            <input type="text" class="form-control checkArtAdd" placeholder="Title" id="newart-title" name="title" required data-validation-required-message="Please enter the article title.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Content</label>
                            <textarea rows="5" class="form-control checkArtAdd" placeholder="Content" id="newart-content" name="content"required data-validation-required-message="Please enter the article content."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="newart-image" name="image">
                    <input type="hidden" class="form-control checkArtAdd" placeholder="User_id" id="newart-usrid" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" required>
                    <input type="hidden" class="form-control checkArtAdd" placeholder="Published" id="newart-pub" name="published" value="1">
                    <br>
                    <div id="success"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <?php include ("layouts/footer.php"); ?>
    
    <!-- Contact Form JavaScript -->
    <script src="ui/assets/js/Modules/articlesModule.js"></script>
    <script src="ui/assets/js/Template/jqBootstrapValidation.js"></script>
    <script src="ui/assets/js/new-article.js"></script>

</body>

</html>
