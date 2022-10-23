<div class="container row video_card_main">

      <?php 
        for ($i=0; $i<18 ; $i++) { 
          echo '<!-- start -->
              <div class="col-md-4 mb-4 video_card wow fadeIn" data-toggle="modal" data-target="#modal_info" data-wow-delay="0.8s">
                <!-- Card -->
                <div class="card card-cascade narrower" style="margin-top: 44px">
                  <!-- Card image -->
                  <div class="view view-cascade overlay">
                    <img src="https://spoonacular.com/recipeImages/123.jpg" class="card-img-top" alt="">
                    <a>
                      <div class="mask rgba-white-slight"></div>
                    </a>
                  </div>
                  <!-- Card image -->
                  <!-- Card content -->
                  <div class="card-body card-body-cascade">
                    <!-- Title -->
                    <h4 class="card-title card-wap" data-toggle="tooltip" title=""></h4>
                    <input type="hidden" name="youtube_id" value="">
                  </div>
                  <!-- Card content -->
                </div>
                <!-- Card -->
              </div>
                <!-- end -->';
        }
      ?>      
    </div>