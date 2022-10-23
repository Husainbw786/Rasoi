      <section id="cuisine_selector" class="mt-3 mb-4">
        <!--Section heading-->
        <div class="row mt-5 mb-2">
          <div class="col-md-12 ">
            <div class="divider-new">
              <h3 class="text-center text-uppercase font-weight-bold mr-3 ml-3 wow fadeIn" data-wow-delay="0.2s">Discover
                our delights</h3>
            </div>
          </div>
        </div>
        <div class="row smooth-scroll cuisine">
          <div class="col-md-12 mb-4">
            <label class="typical_selector"><strong>Cuisine</strong></label>
            <select class="browser-default  custom-select mb-2">
              <option selected>African</option>
              <?php
              $cuisine = array('American','British','Cajun','Caribbean','Chinese','Eastern European','European','French','German','Greek','Irish','Italian','Indian','Japanese','Jewish','Korean','Latin American','Mediterranean','Mexican','Middle Eastern','Nordic','Southern','Spanish','Thai','Vietnamese' );
              for ($i=0; $i < count($cuisine); $i++) {
              echo '<option value="'.$cuisine[$i].'">'.$cuisine[$i].'</option>';
              }
              ?>
            </select>
          </div>
  
          <?php require 'moving_cards.php'; ?> 
          <div class="text-center col-md-12">
            <a class="refresh"><i class="fas fa-forward fa-2x"></i></a>
          </div>
        </div>
        <div class="row smooth-scroll diet">
          <div class="col-md-12 mb-4">
            <label class="typical_selector"><strong>Diet</strong></label>
            <select class="browser-default custom-select mb-2">
              <option selected value="gluten+free">Gluten Free</option>
              <?php
              $diet = array('Vegetarian','Ketogenic','Lacto-Vegetarian','Ovo-Vegetarian','Vegan','Pescetarian','Paleo','Primal','Whole30');
              for ($i=0; $i < count($diet); $i++) {
              echo '<option value="'.$diet[$i].'">'.$diet[$i].'</option>';
              }
              ?>
            </select>
          </div>
  
          <?php require 'moving_cards.php'; ?> 
          <div class="text-center col-md-12">
            <a class="refresh"><i class="fas fa-forward fa-2x"></i></a>
          </div>
        </div>

      </section>
      <!--/Section: Menu intro-->