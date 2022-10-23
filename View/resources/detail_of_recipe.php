<?php 
    error_reporting(0);
    session_start(); 
    if(empty($_SESSION['data'])){
        header('location:../../index.php');
    }    
    // echo '<pre>'; print_r($_SESSION['data']);
     $title=$_SESSION['data']->title;
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Rasoi</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- google font -->
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;562;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script:wght@400;500;562;600;700&display=swap" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="../../public/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="../../public/mdbootstrap/css/mdb.min.css" rel="stylesheet">
        <!-- Main css file -->
        <link href="../../public/assets/css/detail_page.css" rel="stylesheet">
    </head>
    <body>
        <input id="id_input" type="hidden" name="id" value="<?php echo $_SESSION['data']->id; ?>">
        <img class="top_img" src="../../public/assets/images/both_side_vegetable.png">
        <div class="container mt-2">
            <?php
                    $src ='../../public/assets/images/rasoi_animation.png'; 
                    require 'animation.php'; 
            ?>
            <div class="recipe_image_detail_class ">
             <img class="background_image wow fadeIn" data-wow-delay="0.8s" src="<?php echo $_SESSION['data']->image; ?>">
                <div class="recipe_title wow fadeInLeft" >
                    <h2><?php echo $title; ?></h2>
                </div>
                <div class="row m-1">
                    <div class="col-sm-8 col-md-7 col-lg-6 view overlay mb-3 wow fadeInLeft" data-wow-delay="0.4s">
                        <img src="<?php echo $_SESSION['data']->image; ?>" class="img-fluid" alt="">
                        <div class="list_element">
                            <ul class="recipe-specs-2">
                                <?php
                                $field_name = array(
                                'servings' => 'Serv.',
                                'preparationMinutes' => 'Prep min.',
                                'cookingMinutes' => 'Cook min.',
                                'healthScore' => 'Health Score',
                                'gaps' => 'Gaps',
                                'spoonacularScore' => 'User Rating'
                                );
                                foreach ($field_name as $key => $value){
                                echo '<li>'.$value.' : <span>'.$_SESSION['data']->$key.'</span></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-4 col-lg-3 mb-3 wow fadeInRight" data-wow-delay="0.8s">
                        <ul class="list-group">
                            <?php
                            $field_name = array(
                            'vegetarian' => 'Vegetarian',
                            'vegan' => 'Vegan',
                            'glutenFree' => 'Gluten Free',
                            'dairyFree' => 'Dairy Free',
                            'veryHealthy' => 'Very Healthy',
                            'veryPopular' => 'Very Popular',
                            'lowFodmap' => 'Low Fodmap'
                            );
                            foreach ($field_name as $key => $value){
                            echo '<li class="list-group-item">
                                <div class="md-v-line">
                                </div>
                                <i class="true_false fas fa-';
                                if($_SESSION['data']->$key){
                                    echo 'check light-green-text';
                                }
                                else{
                                    echo'times orange-text';
                                }

                                echo ' mr-5">
                                </i>'.$value.'
                            </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="summary text-justify border-top border-dark border-bottom p-3 wow fadeIn" data-wow-delay="0.4s">
                <p class="font-weight-bold"><?php 
                    $sum =explode('.',$_SESSION['data']->summary);
                    echo $sum[0];
                 ?></p>
            </div>

                <?php
                $field_name = array(
                                    'cuisines' => 'Cuisines:',
                                    'dishTypes' => 'Dish Types:',
                                    'diets' => 'Diets:',
                                    'occasions' => 'Occasions:',
                );
                foreach ($field_name as $key => $value) {
                echo '<div class="categories row m-1';
                       if(empty($_SESSION['data']->$key)){
                            echo ' d-none"></div>';                            
                            continue;        
                       }
                    echo '"><div class="col-md-3 '.$key.' type_pad wow fadeIn" data-wow-delay="0.4s">'.$value.'</div>
                        <div class="col-md-9 wow fadeIn" data-wow-delay="0.4s">';
                        foreach ($_SESSION['data']->$key as $inner_key => $inner_value) {
                            echo '<div class="chip m-3">'.$inner_value.'</div>';
                        }    
                        echo '</div></div>';
                }
                ?>
            <?php  
        echo '<div class="categories mb-3 border-bottom wine row m-1';
                if(empty($_SESSION['data']->winePairing->pairedWines)){
                    echo ' d-none"></div>';
                }else{
                    echo ' wow fadeIn" data-wow-delay="0.4s"><div class="col-md-3 type_pad">Wine</div>
                        <div class="col-md-9">';
                    foreach ($_SESSION['data']->winePairing->pairedWines as $inner_key => $inner_value) {
                        echo '<div class="chip m-3">'.$inner_value.'</div>';
                    }
                echo '</div></div>';        
                }
            ?>               
            <div class="row m-1 border rounded p-3 mb-3">
                <div class="col-md-7 pl-2 pr-2 analyzed_ingredient wow fadeIn" data-wow-delay="0.4s">
                    <h3 class="mt-3 mb-3 cursive_heading">Ingredient</h3>
                    <ul>
                        <?php 
                            foreach ($_SESSION['data']->extendedIngredients as $key => $value) {
                                echo '<li class="wow fadeInLeft" data-wow-delay="0.6s"><i class="fas fa-angle-double-right ml-2 mr-2"></i>'.$value->original.'</li>';
                            }
                         ?>
                    </ul>
                    <img class="apple_img" src="../../public/assets/images/apple.780aa803.png">
                </div>
                <div class="col-md-5 nutrition pl-2 pr-2 wow fadeIn" data-wow-delay="0.4s">
                    <h3 class="mt-3 mb-3 cursive_heading">Nutrition</h3>
                    <div class="ml-3">
                        <?php
                        $field_name = array(
                                        '0' => 'Calories',
                                        '1' => 'Fat',
                                        '3' => 'Carbohydrates',
                                        '5' => 'Sugar',
                                        '6' => 'Cholesterol',
                                        '9' => 'Protein',
                                        '22' => 'Iron',
                                        '26' => 'Vitamin C',
                                        '28' => 'Calcium',
                                        '20' => 'Vitamin A',
                                        '21' => 'Potassium',
                                        '11' => 'Vitamin B3',
                                    );
                        $nutrition=$_SESSION['data']->nutrition->nutrients;
                        foreach ($field_name as $key => $value) {
                        echo '<div class="chip wow fadeInRight" data-wow-delay="0.4s">'.$value.':<span class="ml-2">'.$nutrition[$key]->amount.$nutrition[$key]->unit.'</span></div>';
                        }
                        ?>
                    </div>
                    <img class="orange_img wow fadeIn" data-wow-delay="0.4s" src="../../public/assets/images/peach.4f9f9408.png">
                </div>
            </div>
            <!-- analysed ingredient and nutrition div end -->
            <div class="instruction wow fadeIn mb-4" data-wow-delay="0.4s">
                <h3 class="mt-3 mb-3 cursive_heading">Instruction</h3>
                    <?php 
                        $analysed_instruction = $_SESSION['data']->analyzedInstructions[0]->steps;
                        // print_r($analysed_instruction);
                        if(empty($analysed_instruction)){
                            echo '<p> Instruction not found</p>';
                        }else{
                            foreach ($analysed_instruction as $key => $value) {
                                echo '<!-- start div  --><div class="row m-1 mb-3 mt-2 border-bottom wow fadeIn" data-wow-delay="0.4s"><div class="col-md-7"><h5><i class="fas fa-angle-double-right ml-2 mr-2">
                                </i>'.$value->step.'</h5></div>';
                                if(!empty($value->ingredients)){
                                    echo '<div class="col-md-3">';
                                    // print_r($value);
                                        foreach ($value->ingredients as $inner_key => $inner_value) {
                                            echo '<div class="img_chip" data-toggle="tooltip" title="'.$inner_value->name.'"><img src="https://spoonacular.com/cdn/ingredients_100x100/'.$inner_value->image.'"></div>';
                                        }
                                    echo '</div>';
                                }
                                if(!empty($value->equipment)){
                                    echo '<div class="col-md-2 ">';
                                        foreach ($value->equipment as $inner_key => $inner_value) {
                                            echo '<div class="img_chip" data-toggle="tooltip" title="'.$inner_value->name.'"><img src="https://spoonacular.com/cdn/equipment_100x100/'.$inner_value->image.'"></div>';
                                        }
                                    echo '</div>';
                                }
                        echo '</div><!-- end div  -->';                           
                            }   
                        }
                     ?>
                </div>
            <!-- instruction div end here -->
            <!-- <div class="variation border-dark bg-light p-3 mb-3 mt-4">
                <h3 class="mt-3 mb-3">Variation</h3>
                <div class="">
                    <h5 class="mb-3"><i class="fas fa-angle-double-right ml-2 mr-2"></i></h5>
                    <h5 class="mb-3"><i class="fas fa-angle-double-right ml-2 mr-2"></i>Wine</h5>
                    <h5 class="mb-3"><i class="fas fa-angle-double-right ml-2 mr-2"></i></h5>
                    <h5 class="mb-3"><i class="fas fa-angle-double-right ml-2 mr-2"></i></h5>
                </div>
            </div> -->
        <?php session_unset(); ?>
            <h3 class="mt-3 mb-3 cursive_heading">Similar Recipe</h3>
            <div class="card_main_animation">
            <?php
                $src ='../../public/assets/images/rasoi_animation.png'; 
                require 'animation.php'; 
            ?>
                
            <?php require 'recipe_results_cards.php'; ?>
            </div>
        </div>
        <!-- SCRIPTS -->

        <!-- JQuery -->
        <script type="text/javascript" src="../../public/mdbootstrap/js/jquery-3.4.1.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../../public/mdbootstrap/js/popper.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../../public/mdbootstrap/js/bootstrap.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../../public/mdbootstrap/js/mdb.min.js"></script>
        <!-- javascript file for welcome page -->
        <script type="text/javascript" src="../../public/assets/js/detail_page.js"></script>

        <script>
        //Animation init
        new WOW().init();
        </script>
    </body>
</html>