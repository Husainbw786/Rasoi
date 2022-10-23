<?php
 require '../Controller/google_controller_configue.php';
?>
<!--Modal -->
<div class="modal fade" id="ModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <!--Content-->
    <div class="modal-content form-elegant">
      <!--Header-->
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"></h3>
        <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body mx-4">
       <!-- Material form login -->
            <!-- Form -->
            <form class="text-center login_form" style="color: #757575;" action="#!">
              <!-- Email -->
              <div class="md-form email">
                <input type="email" id="email" class="form-control">
                <label for="email">E-mail</label>
                <p class="text-warning"></p>
              </div>

              <!-- Password -->
              <div class="md-form password">
                <input type="password" id="password" class="form-control">
                <label for="password">Password</label>
                <p class="text-warning"></p>
              </div>

              <div class="d-flex justify-content-around">
                <div>
                  <!-- Remember me -->
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                    <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                  </div>
                </div>
                <div>
                  <!-- Forgot password -->
                  <a href="">Forgot password?</a>
                </div>
              </div>

              <!-- Sign in button -->
              <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" 
              type="submit" id="login_submit" >Sign in</button>
              <!-- Social login -->
              <p>or sign in with:</p>
              <a type="button" onclick="window.location = '<?php echo $gClient->createAuthUrl(); ?>';" class="btn-floating btn-primary btn-sm">
                <i class="fab fa-google"></i>
              </a>
<!--               <a type="button" class="btn-floating btn-fb btn-sm">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a type="button" class="btn-floating btn-tw btn-sm">
                <i class="fab fa-twitter"></i>
              </a>
              <a type="button" class="btn-floating btn-li btn-sm">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a type="button" class="btn-floating btn-git btn-sm">
                <i class="fab fa-github"></i>
              </a>
 -->
            </form>
            <!-- Form -->
        <!-- Material form login -->
        <!-- Material form register -->
        <!-- Form -->
        <form class="text-center register" style="color: #757575;" action="#!">

            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form f-name">
                        <input type="text" id="first_name" class="form-control" required>
                        <label for="FirstName">First name</label>
                        <p class="text-warning"></p>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="last_name" class="form-control">
                        <label for="LastName">Last name</label>
                    </div>
                </div>
            </div>

            <!-- E-mail -->
            <div class="email md-form mt-0">
              <input type="email" id="email" class="form-control" required>
              <label for="email">Email</label>
              <p class="text-warning"></p>
            </div>

            <!-- Password -->
            <div class="password1 md-form">
                <input type="password" id="password" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
                <label for="Password">Password</label>
                <p class="text-warning"></p>
            </div>
            <!-- check Password -->
            <div class="password2 md-form">
                <input type="password" id="password_chk" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
                <label for="Password">Re-Enter Password</label>
                <p class="text-warning"></p>
            </div>
           <div class="form-inline row">
              <div class="col-4">
                Male
                <input checked type="radio" name="Gender"  value="male" class="custom-radio ml-1" >
              </div>
              <div class="col-4">
                Female
                <input type="radio" name="Gender" value="female" class="custom-radio ml-1">
              </div>
              <div class="col-4">
                Other
                <input type="radio" name="Gender" value="other" class="custom-radio ml-1">
              </div>
          </div>


            <!-- Sign up button -->
            <button id ="register" type="submit" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0">Register</button>
        </form>
        <!-- Form -->
<!-- Material form register -->
   <!-- Grid column -->
          <div class="mb-4 profile user_profile">

            <!-- Card -->
            <div class="card profile-card">

              <!-- Avatar -->
              <div class="avatar z-depth-1-half mb-4">
                <img src="<?php 
                if(empty($_SESSION['user_detail']['image_url'])){
                  echo '../../public/assets/images/useravatar.png';
                }else{
                  echo $_SESSION['user_detail']['image_url'];
                } ?>" class="rounded-circle" style="max-width: 150px;" alt="user-image">
              </div>

              <div class="card-body pt-0 mt-0">

                <!-- Name -->
                <h3 class="mb-3 font-weight-bold"><strong><?php echo $_SESSION['user_detail']['name'].' '.$_SESSION['user_detail']['last_name']; ?></strong></h3>
                <h6 class="font-weight-bold cyan-text mb-4"><?php echo $_SESSION['user_detail']['email'] ?></h6>

                <p class="mt-4 text-muted">Your's favorite recipe</p>

              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

      </div>
      <!--Footer-->
      <div class="modal-footer login_registration_footer mx-5 pt-3 mb-1">
        <p class="text-warning"></p>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Modal