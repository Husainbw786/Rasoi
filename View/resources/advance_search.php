<div class="search_tag">
  <!-- All types and catogary like Cuisine Diet etc -->
  <div class="row pt-2 text-white">
    <div class="col-md-3 mb-4 cuisine">
      <label><strong>Cuisine</strong></label>
      <select class="browser-default  tag_maker custom-select mb-2">
        <option selected>all</option>
        <?php
        $cuisine = array('African','American','British','Cajun','Caribbean','Chinese','Eastern European','European','French','German','Greek','Indian','Irish','Italian','Japanese','Jewish','Korean','Latin American','Mediterranean','Mexican','Middle Eastern','Nordic','Southern','Spanish','Thai','Vietnamese' );
        for ($i=0; $i < count($cuisine); $i++) {
        echo '<option value="'.$cuisine[$i].'">'.$cuisine[$i].'</option>';
        }
        ?>
      </select>
    </div>
    <div class="col-md-3 mb-4 diet">
      <label><strong>Diet</strong></label>
      <select class="browser-default custom-select mb-2">
        <option selected>all</option>
        <?php
        $diet = array('Gluten Free','Ketogenic','Vegetarian','Lacto-Vegetarian','Ovo-Vegetarian','Vegan','Pescetarian','Paleo','Primal','Whole30');
        for ($i=0; $i < count($diet); $i++) {
        echo '<option value="'.$diet[$i].'">'.$diet[$i].'</option>';
        }
        ?>
      </select>
    </div>
    <div class="col-md-3 mb-4 intolerance">
      <label><strong>Intolerance</strong></label>
      <select class="browser-default  tag_maker custom-select mb-2">
        <option selected>none</option>
        <?php
        $intolerance = array('Dairy','Egg','Gluten','Grain','Peanut','Seafood','Sesame','Shellfish','Soy','Sulfite','Tree Nut','Wheat');
        for ($i=0; $i < count($intolerance); $i++) {
        echo '<option value="'.$intolerance[$i].'">'.$intolerance[$i].'</option>';
        }
        ?>
      </select>
    </div>
    <div class="col-md-3 mb-4 type">
      <label><strong>Type</strong></label>
      <select class="browser-default custom-select mb-2">
        <option selected>all</option>
        <option value='main+course'>main course</option>
        <option value='side+dish'>side dish</option>
        <?php
        $type = array('dessert','appetizer','salad','bread','breakfast','soup','beverage','sauce','marinade','fingerfood','snack','drink');
        for ($i=0; $i < count($type); $i++) {
        echo '<option value="'.$type[$i].'">'.$type[$i].'</option>';
        }
        ?>
      </select>
    </div>
  </div>
  <!-- All types and catogary like Cuisine Diet etc -->
  <!-- Ingredient Search exlude and include-->
  <div class="Ingredient-search">
    <div class="dropdown">
      <button class="btn search-toggle dropdown-toggle" type="button" id="dropdownMenu"
      data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"></button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
        <h6 class="dropdown-header">Select type for search</h6>
        <a class="dropdown-item">Include Ingredient</a>
        <a class="dropdown-item">Exclude Ingredient</a>
      </div>
    </div>
    <div class="search-form">
      <input class="form-control Ingredient-input form-control-sm mr-3 " type="text" placeholder="Search For Ingredient"
      aria-label="Search">
      <div class="suggession_bar">
        <?php
        for ($i=0; $i < 5; $i++) {
        echo '<div class="suggession_bar_item">
          <span></span>
          <img class="suggession_bar_image" src="">
        </div>';
        }
        ?>
      </div>
    </div>
  </div>
    <!-- Ingredient Search exlude and include-->
    <!-- Exclude and include ingredient -->
        <div class="row">
      <div class="col-md-6 include_ingredient">
      </div>
      <div class="col-md-6 exclude_ingredient">
      </div>     
    </div>
    <!-- Exclude and include ingredient -->
        <div class="row text-center text-white">
      <div class="carb_pro col-md-4">
        <h5><strong>Carbohydrates and Protein</strong></h5>
        <div class="slider_carb_pro">
          <h6>Carbs</h6>
          <input class="nutrition_value" type="hidden" name="Carbs" value="minCarbs">
          <div class="d-flex justify-content-center mb-4">
            <div class="w-100">
              <input type="range" class="custom-range" id="customRange11" value="0" min="10" max="100">
            </div>
            <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>
          </div>
        </div>
        <div class="slider_carb_pro">
          <h6>Protein</h6>
          <input class="nutrition_value" type="hidden" name="Protein" value="minProtein">
          <div class="d-flex justify-content-center mb-4">
            <div class="w-100">
              <input type="range" class="custom-range" id="customRange11" value="0" min="10" max="100">
            </div>
            <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>
          </div>
        </div>
        <div class="slider_carb_pro">
          <h6>Calories</h6>
          <input class="nutrition_value" type="hidden" name="Calories" value="minCalories">
          <div class="d-flex justify-content-center mb-4">
            <div class="w-100">
              <input type="range" class="custom-range" id="customRange11" value="0" min="50" max="800">
            </div>
            <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>
          </div>
        </div>
        <div class="slider_carb_pro">
          <h6>Fat</h6>
          <input class="nutrition_value" type="hidden" name="Fat" value="minFat">
          <div class="d-flex justify-content-center mb-4">
            <div class="w-100">
              <input type="range" class="custom-range" id="customRange11" value="0" min="1" max="100">
            </div>
            <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>
          </div>
        </div>
        <?php
        $carb_pro = array(
        'minAlcohol'      =>  'Alcohol',
        'minCaffeine'     =>  'Caffeine',
        'minCopper'       =>  'Copper',
        'minCalcium'      =>  'Calcium',
        'minCholine'      =>  'Choline',
        'minCholesterol'  =>  'Cholesterol',
        'minFluoride'     =>  'Fluoride',
        'minSaturatedFat' =>  'Saturated Fat',
        );
        foreach($carb_pro as $key => $value) {
        echo '<div class="slider_carb_pro">
          <h6>'.$value.'</h6>
          <input class="nutrition_value" type="hidden" name="'.$value.'" value="'.$key.'">
          <div class="d-flex justify-content-center mb-4">
            <div class="w-100">
              <input type="range" class="custom-range" id="customRange11" value="0" min="0" max="100">
            </div>
            <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>
          </div>
        </div>';
        }
        ?>
      </div>
      <div class="vitamin col-md-4">
        <h5><strong>Vitamin</strong></h5>
        <?php
        $vitamin = array(
        'minVitaminA'   => 'Vitamin A',
        'minVitaminC'   => 'Vitamin C',
        'minVitaminD'   => 'Vitamin D',
        'minVitaminE'   => 'Vitamin E',
        'minVitaminK'   => 'Vitamin K',
        'minVitaminB1'  => 'Vitamin B1',
        'minVitaminB2'  => 'Vitamin B2',
        'minVitaminB3'  => 'Vitamin B3',
        'minVitaminB5'  => 'Vitamin B5',
        'minVitaminB6'  => 'Vitamin B6',
        'minVitaminB12' => 'Vitamin B12',
        );
        foreach($vitamin as $key => $value) {
        echo '<div class="slider_vitamin">
          <h6>'.$value.'</h6>
          <input class="nutrition_value" type="hidden" name="'.$value.'" value="'.$key.'">
          <div class="d-flex justify-content-center mb-4">
            <div class="w-100">
              <input type="range" class="custom-range" id="customRange11" value="0" min="0" max="100">
            </div>
            <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>
          </div>
        </div>';
        }
        ?>
      </div>
      <div class="mineral col-md-4">
        <h5><strong>Minerals</strong></h5>
        <?php
        $mineral = array(
        'minFiber'      => 'Fiber',
        'minFolate'     => 'Folate',
        'minFolicAcid'  => 'Folic Acid',
        'minIodine'     => 'Iodine',
        'minIron'       => 'Iron',
        'minMagnesium'  => 'Magnesium',
        'minManganese'  => 'Maganese',
        'minPhosphorus' => 'Phosphorus',
        'minPotassium'  => 'Potassium',
        'minSelenium'   => 'Selenium',
        'minSodium'     => 'Sodium',
        'minSugar'      => 'Sugar',
        'minZinc'       => 'Zinc',
        );
        foreach($mineral as $key => $value) {
        echo '<div class="slider_mineral">
          <h6>'.$value.'</h6>
          <input class="nutrition_value" type="hidden" name="'.$value.'" value="'.$key.'">
          <div class="d-flex justify-content-center mb-4">
            <div class="w-100">
              <input type="range" class="custom-range" id="customRange11" value="0" min="0" max="100">
            </div>
            <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>
          </div>
        </div>';
        }
        ?>
      </div>
    </div>
</div>
