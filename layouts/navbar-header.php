<!--Navbar-->  
  <nav class="navbar fixed-top navbar-toggleable-md navbar-light" id="mainNav">
      <div class="container">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              Menu <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand" href="home.php"><img id="logo" src="ui/assets/img/logo-siit.png" alt="Logo Scoala Informala de IT" width=42px; height=42px;"><span id="text">Scoala Informala de IT</a>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="home.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="contact.php">Contact</a>
                  </li>
                  <?php 
                  if (!isset($_SESSION['role'])) {
                      $buttons = '<li class="nav-item">
                                      <a class="nav-link btn btn-navbar" href="signup.php"><span>Sign Up</span></a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link btn btn-navbar" href="login.php"><span>Log In</span></a>
                                  </li>';
                  } else if (($_SESSION['role'] === 'guest') || ($_SESSION['role'] === 'user')){
                      $buttons = '<li class="nav-item">
                                      <a class="nav-link btn btn-navbar" href="logout.php"><span>Log Out</span></a>
                                  </li>';
                  } else if ($_SESSION['role'] === 'admin'){
                      $buttons = '<li class="nav-item">
                                      <a class="nav-link btn btn-navbar" href="new_article.php"><span>Add Article</span></a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link btn btn-navbar" href="logout.php"><span>Log Out</span></a>
                                  </li>';
                  } else {
                      $buttons = '<li class="nav-item">
                                      <a class="nav-link btn btn-navbar" href="signup.php"><span>Sign Up</span></a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link btn btn-navbar" href="login.php"><span>Log In</span></a>
                                  </li>';
                  }
                  echo $buttons;
                  ?>
              </ul>
          </div>
      </div>
  </nav>
  
<!-- Page Header -->
<header class="masthead" style="background-image: url('ui/assets/img/header-bg.png')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="site-heading">
                    <h1>Web Course</h1>
                    <span class="subheading">notes & examples</span>
                </div>
            </div>
        </div>
    </div>
</header>