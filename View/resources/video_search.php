<div class="video_search pb-4">
  <div class="row pt-2 ml-2 mr-2 mb-2" >
    <div class="col-md-4 mb-4 cuisine">
      <label>Cuisine</label>
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
    <div class="col-md-4 mb-4 diet">
      <label>Diet</label>
      <select class="browser-default custom-select mb-2">
        <option selected>all</option>
        <option value="Gluten Free">Gluten Free</option>
        <option value="Ketogenic">Ketogenic</option>
        <option value="Vegetarian">Vegetarian</option>
        <option value="Lacto-Vegetarian">Lacto-Vegetarian</option>
        <option value="Ovo-Vegetarian">Ovo-Vegetarian</option>
        <option value="Vegan">Vegan</option>
        <option value="Pescetarian">Pescetarian</option>
        <option value="Paleo">Paleo</option>
        <option value="Primal">Primal</option>
        <option value="Whole30">Whole30</option>
      </select>
    </div>
    <div class="col-md-4 mb-4 type">
      <label>Type</label>
      <select class="browser-default custom-select mb-2">
        <option selected>all</option>
        <?php
        $type = array('main course','side dish','dessert','appetizer','salad','bread','breakfast','soup','beverage','sauce','marinade','fingerfood','snack','drink');
        for ($i=0; $i < count($type); $i++) {
        echo '<option value="'.$type[$i].'">'.$type[$i].'</option>';
        }
        ?>
      </select>
    </div>
  </div>
  <!-- Row Over -->
  <div class="Ingredient-search">
    <div class="dropdown">
      <button class="btn search-toggle dropdown-toggle" type="button" id="dropdownMenu"
      data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"></button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
        <h6 class="dropdown-header">Select type for search</h6>
        <a class="dropdown-item" >Include Ingredient</a>
        <a class="dropdown-item" >Exclude Ingredient</a>
      </div>
    </div>
    <div class="search-form">
      <input class="form-control Ingredient-input form-control-sm mr-3 w-75" type="text" placeholder="Search For Ingredient"
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
  <!-- Ingredient Search over-->
  <div class="row">
    <div class="col-md-6 include_ingredient"></div>
    <div class="col-md-6 exclude_ingredient"></div>
  </div>
  <div class="row text-center text-white">
  </div>
</div>