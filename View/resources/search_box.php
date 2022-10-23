<!-- search bar  -->

<div class="search_background_div">
  <div class="main-search" >
    <div class="dropdown">
      <button class="btn search-toggle dropdown-toggle" type="button" id="dropdownMenu"
      data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><strong>Recipe</strong></button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
        <h6 class="dropdown-header">Select type for search</h6>
        <a class="dropdown-item ">Recipe</a>
        <a class="dropdown-item">Ingredient</a>
        <a class="dropdown-item">Video Search</a>
        <a class="dropdown-item">Advance Search</a>
      </div>
    </div>
    <div class="search-form">
      <input class="form-control search-input form-control-sm mr-3" type="text" placeholder="Search"
      aria-label="Search">
      <i class="fas search-icon fa-search" style="background-color: white" aria-hidden="true"></i>
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
  <div class="margin_padding_background">
    <div class="for_ingredient_tag">
    </div>
  </div>
</div>
<!-- search bar  -->