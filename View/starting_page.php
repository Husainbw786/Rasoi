<?php 
  error_reporting(0);
  session_start();
  $login_flag=false;
  if (!empty($_SESSION['user_detail']['id']) && isset($_SESSION['user_detail']['id']) ) {
    $login_flag=true;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Rasoi</title>
  <!-- google font dancing script -->
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../public/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../public/mdbootstrap/css/mdb.min.css" rel="stylesheet">
  <!-- Main css file -->
  <link href="../public/assets/css/index.css" rel="stylesheet">
</head> 

<body class="rasoi-lp">

  <!--Navigation & Intro-->
    <?php 
        require_once 'resources/header.php';
        require_once 'resources/chatbot.php';
     ?>

   <!--/Navigation & Intro-->
  <!--Main content-->
    <div class="animation">
      <?php
                $src ='../public/assets/images/rasoi_animation.png'; 
                require 'resources/animation.php'; 
            ?>
    </div>
  <main>

  <?php 
    require_once 'resources/img_model.php'; 
    require_once 'resources/form_modal.php'; 
    require_once 'resources/search_box.php';
    require_once 'resources/video_search.php';
    require_once 'resources/advance_search.php';
    require_once 'resources/recipe_results_cards.php'; 
    require_once 'resources/video_cards.php'; 
  ?>
    <!-- dynamic contain -->


    <!-- dynamic contain -->
    <!--First container-->
  <div class="all_div_to_hide">
    <?php require_once 'resources/special_ocassion.php'; ?>
    <!-- about section -->
    <?php require_once 'resources/about.php'; ?>
    <!-- about section -->
    <!--Streak-->
    <div class="streak streak-photo streak-long-2" style="background-image: url('../public/assets/images/light_green_background_srounded_by_fruite_and_bottle.jpg');">
      <div class="flex-center mask rgba-black-strong">
        <div class="text-center white-text ">
          <h2 class="h2-responsive overflow-auto  mb-5 pl-2 pr-2">
            <i class="fas fa-quote-left" aria-hidden="true"></i><span class="random_quates ml-2 mr-2"></span>
            <i class="fas fa-quote-right" aria-hidden="true"></i>
          </h2>
        </div>
      </div>
    </div>
    <!--/Streak-->

    <!--Second container-->
    <div class="container">
      <?php require 'resources/cuisine_selector.php'; ?>
      <!--Section: Menu intro-->

    </div>

    <hr>

    <!--Section: Menu types-->
    <div class="container">

      <?php require 'resources/menu_types.php'; ?>

    </div>
    <!--/Section: Menu types-->

    <!--Streak-->
    <div class="streak streak-photo streak-long-2" style="background-image:url('../public/assets/images/light_orange_background_right_side_fruites.jpg')">
        <div class="flex-center mask rgba-black-strong">
        <div class="text-center white-text ">
          <h2 class="h2-responsive overflow-auto  mb-5 pl-2 pr-2">
            <i class="fas fa-quote-left" aria-hidden="true"></i><span class="random_jokes ml-2 mr-2"></span>
            <i class="fas fa-quote-right" aria-hidden="true"></i>
          </h2>
        </div>
      </div>
    </div>
    <!--/Streak-->

    <!--Section: Menu-->
    <div class="container-fluid">
      <?php require 'resources/recipe_for_user.php'; ?>
    </div>
    <!--/Section: Menu-->

    <div class="container-fluid">

      <!--Section: team detail v.3-->
      <section id="team_deatail" class="team-section mt-2 mb-5">

          <!--Secion heading-->
          <div class="row mt-5 mb-4">
            <div class="col-md-12">
              <div class="divider-new">
                <h3 class="text-center text-uppercase font-weight-bold mr-3 ml-3 wow fadeIn" data-wow-delay="0.2s">Our
                  Team Detail</h3>
              </div>
            </div>
            <!--First row-->
            <div class="w-100 row text-center" style="justify-content: center;">
             <?php 
                $fb='<a class="fb-ic" target="_blank" href="https://www.facebook.com/MurtazaFabiedude">
                      <i class="fab fa-facebook-f fa-lg primary-text mr-4"> </i>
                    </a>';
                $twitter='<a class="tw-ic" target="_blank" href="https://twitter.com/MurtuzFabiedude">
                            <i class="fab fa-twitter fa-lg primary-text mr-4"> </i>
                          </a>';
                $insta='<a class="ins-ic" target="_blank" href="https://www.instagram.com/_mur_tuzz_/">
                          <i class="fab fa-instagram fa-lg primary-text mr-4"> </i>
                        </a>';
                $linkdin='<a class="li-ic" target="_blank" href="https://www.linkedin.com/in/mur-tuzz/">
                            <i class="fab fa-linkedin-in fa-lg primary-text mr-4"> </i>
                          </a>';
                $name='Murtaza Lightwala';
                $img='../public/assets/images/murtaza_lightwala.jpg'; 
                $txt='Full Stack Developer'; 
                require 'resources/team-detail.php';              
             ?>
            </div>
            <!--/First row-->
          </div>

      </section>
      <!--/Section: team detail v.3-->

    </div>
  </div>
  </main>
  <!--/Main content-->
  <!--Footer-->
  <footer class="page-footer text-center text-md-left pt-4">
    <!--Footer Links-->
    <div class="container mb-4">
      <?php require_once 'resources/footer.php';   ?>
    </div>
    <!--/Footer Links-->
    <!--Copyright-->
    <div class="text-center" data-wow-delay="0.3s">
      <div class="container-fluid">
        <strong>Magical Solutions Pvt Ltd</strong>
        <p class=" text-light">All Right Reserve</p>
      </div>
    </div>
    <!--/Copyright-->

  </footer>
  <!--/Footer-->


  <!-- SCRIPTS -->

  <!-- JQuery -->
  <script type="text/javascript" src="../public/mdbootstrap/js/jquery-3.4.1.min.js"></script>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../public/mdbootstrap/js/popper.min.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../public/mdbootstrap/js/bootstrap.min.js"></script>

  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../public/mdbootstrap/js/mdb.min.js"></script>
  <!-- javascript file for welcome page -->
  <script type="text/javascript" src="../public/assets/js/index.js"></script>

  <script>
    //Animation init
    new WOW().init();

    //Modal
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').focus()
    })

    // MDB Lightbox Init
    $(function () {
      $("#mdb-lightbox-ui").load("../public/mdbootstrap/mdb-addons/mdb-lightbox-ui.html");
    });

  </script>

</body>

</html>
