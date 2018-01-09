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

    <title>Contact</title>

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
                <h1>Contact form</h1>
                <p>Questions or feedback? Easily get in touch by filling out the form below. We'll get back to you in no time!</p>
                <form name="contactForm" id="contactForm" novalidate>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Email Address</label>
                            <input type="email" class="form-control checkContact" placeholder="Email Address" id="msg-email" name="email" required data-validation-required-message="Please enter your email address." value="<?php if (isset($_SESSION['email'])) {echo $_SESSION['email'];} ?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Message Title</label>
                            <input type="text" class="form-control checkContact" placeholder="Message Title" id="msg-title" name="title" required data-validation-required-message="Please enter a message title.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Message Content</label>
                            <textarea rows="5" class="form-control checkContact" placeholder="Message Content" id="msg-content" name="content" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
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
    <script src="ui/assets/js/Modules/contactsModule.js"></script>
    <script src="ui/assets/js/Template/jqBootstrapValidation.js"></script>
    <script src="ui/assets/js/contact.js"></script>

</body>

</html>
