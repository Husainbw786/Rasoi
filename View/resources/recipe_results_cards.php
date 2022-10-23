<!-- card view -->
    <div class="container row card_main">

      <?php 
        for ($i=0; $i<18 ; $i++) { 
          echo '<!-- start -->
              <div class="col-md-4 mb-4 data_card wow fadeIn" data-wow-delay="0.4s">
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
                    <input type="hidden" name="id" value="">
                    <!-- recipe card -->
                    <h6 class="pink-text recipe"><i class="mr-2 fas fa-clock"></i>Ready in:<span class="ml-1 prep"></span></h6>
                    <h6 class="pink-text recipe"><i class="mr-2 fas fa-concierge-bell"></i>serving:<span class="ml-1 serv"></span></h6>
                    <!-- ingredients card -->
                    <div class="used_ingredient ingredient">
                      <h6 class="pink-text">used Ingredient</h6>
                    </div>
                    <div class="missed_ingredient ingredient">
                      <h6 class="pink-text">Missed Ingredient</h6>
                    </div>
                  </div>
                  <!-- Card content -->
                </div>
                <!-- Card -->
              </div>
                <!-- end -->';
        }
      ?> 
      <div class="text-center col-md-12">
          <a class="refresh"><i class="fas fa-forward fa-2x"></i></a>
        </div>     
    </div>
    <!-- card view -->