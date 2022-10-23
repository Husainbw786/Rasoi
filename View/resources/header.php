   <!--Navbar-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">
        <a class="navbar-brand text-white" id="website-title">
          <strong>Rasoi</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!--Links-->
          <ul class="navbar-nav mr-auto smooth-scroll">
            <li class="nav-item">
              <a class="nav-link" id="home-link" href="#home">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="search-link" data-offset="100">Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about" id="about-link" data-offset="100">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#cuisine_selector" id="cuisine-link" data-offset="100">Discover
                our delights</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#recipe_for_user" id="special-link" data-offset="100">Just For You</a>
            </li>
          </ul>

          <?php
            if($GLOBALS['login_flag']){
              echo '</div>
                    <a class="navbar-brand text-white loged_in" data-toggle="modal" data-target="#ModalForm"  id="user_name">
                      <strong>hi, '.$_SESSION['user_detail']['name'].'</strong>
                    </a>
                    <a href="resources/logout.php">
                      <i class="fas fa-power-off text-white font-weight-bold float-right"></i>
                    </a>
';
            }else{
              echo '<div class="navbar-nav nav-flex-icons loged_out">
                      <ul class="navbar-nav mr-auto smooth-scroll">
                        <li class="nav-item">
                          <a class="login_modal nav-link"  data-toggle="modal" data-target="#ModalForm">Log in</a>  
                        </li>
                        <li class="nav-item">
                          <a class="sign_up_modal nav-link"  data-toggle="modal" data-target="#ModalForm">Register</a>
                        </li>
                      </ul>
                    </div>
                  </div>';    
              }
          ?>
      </div>
    </nav>
    <!--/Navbar-->

    <!-- Intro Section -->
    <div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' >
      <div class="mask rgba-black-slight">
        <div class="container h-100 d-flex justify-content-center align-items-center">
          <div class="row smooth-scroll">
            <div class="col-md-12 text-white text-center">
              <div class="wow fadeInDown fade_background mb-3" data-wow-delay="0.2s">
                <h2 class="display-3 font-weight-bold mb-2 mt-5 mt-xl-2">Rasoi</h2>
                <hr class="text-white">
                <h4 class="subtext-header mt-2 mb-3">All <strong>Recipes</strong> related query</h4>
                <h4 class="subtext-header mt-2 mb-3">So congrates you got the solutions</h4>
                <h4 class="mb-5 clearfix d-none d-md-inline-block">Here you get all types of food recipes, recipe by ingredients, your diet plan, recipe nutrition facts and many more log in to have much for features</h4>
              </div>
              <?php 
                  if(!$GLOBALS['login_flag']){
                    echo '<a class="login_modal model_button btn btn-cyan btn-rounded wow fadeInUp" data-wow-delay="0.2s" data-toggle="modal" data-target="#ModalForm">
                          <i class="fas fa-user-circle"></i>
                          <span>Log in</span>
                        </a>
                        <a class="sign_up_modal model_button btn btn-deep-orange btn-rounded wow fadeInUp" data-toggle="modal" data-target="#ModalForm" data-wow-delay="0.2s">
                          <i class="fas fa-user-circle"></i>
                          <span>Register</span>
                        </a>';
                  } 
               ?>
            </div>
          </div>
        </div>
      </div>
    </div>
 