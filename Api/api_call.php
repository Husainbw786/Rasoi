<?php
	error_reporting(0);
	$configue = parse_ini_file('../app.ini');
	$rand = 0;

	// error_log('api Call in API folder');
	class ApiCall {
		
		// private static $configue = parse_ini_file('../app.ini');
		/**
		* [get_api_meta_data description] the purpose was to have a function in which
		* we first send id then we get subpart of api, it will return the subpart of api.
		* so we don't have to send complete information just key will required.
		* @param [multidimensional Associative array] $rasoi_items its has complete sub url.
		* @param [int] $id It is for which we are searching for recipe it present in some part.
		* @param [string] $category.
		* @param [string] $subcategory.
		* @return [string] It will return the main contain of url.
		*/
		private function get_api_meta_data($category, $subcategory, $id=0){

			$rasoi_items = array('recipes' => array(
												'search' => "recipes/search",
												'food' => "food/search",
												'nutrients' => "recipes/findByNutrients",
												'ingredients' => "recipes/findByIngredients",
												'complex' => "recipes/complexSearch",
												'information' => "recipes/".$id."/information",
												'information_bulk' => "recipes/informationBulk",
												'similar' => "recipes/".$id."/similar?",
												'random' => "recipes/random",
												'autocomplete' => "recipes/autocomplete",
												'equipment_widget' => "recipes/".$id."/equipmentWidget.json?",
												'price_breakdown_widget' => "recipes/".$id."/priceBreakdownWidget.json",
												'ingredient_widget' => "recipes/".$id."/ingredientWidget.json",
												'nutrition_widget' => "recipes/".$id."/nutritionWidget.json",
												'analyzed_instructions' => "recipes/".$id."/analyzedInstructions",
												'extract' => "recipes/extract",
												'summary' => "recipes/".$id."/summary?",
												'guess_nutrition' => "recipes/guessNutrition",
												),
								'ingredient' => array(
												'information' => 'food/ingredients/'.$id.'/information',
												'convert' => 'recipes/convert',
												'parse_ingredients' => 'recipes/parseIngredients',
												'autocomplete' => 'food/ingredients/autocomplete',
												'substitutes' => 'food/ingredients/substitutes',
												'substitutes_by_id' => "food/ingredients/".$id."/substitutes",
												),
								'product' => array(
												'search' => 'food/products/search',
												'upc' => 'food/products/upc/'.$id,
												'information' => 'food/products/'.$id,
												'upc_comparable' => 'food/products/upc/'.$id.'/comparable',
												'autocomplete' => 'food/products/suggest',
												),
								'menu_items' => array(
												'search' => "food/menuItems/search",
												'information' => "food/menuItems/".$id,
												'food' => "food/search",
												'autocomplete' => "food/menuItems/suggest",
												),
								'meal_plan' => "mealplanner/generate",
												'wine' => array(
												'dishes' => "food/wine/dishes",
												'pairing' => "food/wine/pairing",
												'description' => "food/wine/description",
												'recommendation' => "food/wine/recommendation",
												),
								'misc' => array(
												'answer' => "recipes/quickAnswer",
												'pairing' => "food/detect",
												'video' => "food/videos/search",
												'jokes' => "food/jokes/random?",
												'fact' => "food/trivia/random?",
												'chatbot' => "food/converse",
												'chat_suggestion' => "food/converse/suggest",
												)
											);
			return $rasoi_items[$category][$subcategory];

		}

		/**
		* [get_api_key description] the purpose have this function is to change the api key
		* so that we don't have a burden on single key as we just had 150 call a day.
		* @param [static int] $rand for counting number of times function get invoke.
		* @param [string] $api_key_name used to fetch api key from config file
		* @return [string] It will return the api key.
		*/
		private function get_api_key(){
			
			error_log($GLOBALS['rand']);
			if($GLOBALS['rand']>20){
				$GLOBALS['rand']=0;
			}
			// error_log($GLOBALS['configue']['API_KEY'][$GLOBALS['rand']].'rand value'.$GLOBALS['rand']);
			return $GLOBALS['configue']['API_KEY'][$GLOBALS['rand']];
		}

		/**
		* [request description] we are using curl here to fetch api data as getfilecontain(), sometime
		* fails to get data.
		* @param [object] $ch used to invoke curl
		* @param [string] $head used to store api data returned from curl
		* @return [Json] It will return the complete data in jSon format.
		*/
		private function request($url){

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //return the respond if false it will print
			$head = curl_exec($ch); //we get the data
			// error_log('got response from api');
			// error_log('------------------------------------------------------------------------');
			// error_log(print_r($head));
			// error_log('------------------------------------------------------------------------');
			curl_close($ch);
			return $head;
		}

		/**
		* [api_call description] in this function I am assembling the data! its root function
		* where all data is been fetched and return to controller.
		* @param [associative array] $query it is used for building api url with
		* @category like type of data and how much data we want.
		* @param [string] $category in category we get short form of category.
		* @param [string] $subcategory here i get short form of subcategory.
		* @param [string] $url_category_part I are fetching sub part of url from get_api_meta_data()
		* @param [string] $sub_query fetching data from query array nd concanating in URL
		* @param [string] $api_key we are getting key from get_api_key().
		* and storing here.
		* @param [string] $url building a complete url to send in curl function and receive data.
		* @return [Json] it will return jSon data to caller function
		*/
		public function api_call($category, $subcategory, $query, $rand, $id = 0){
			$GLOBALS['rand']=$rand;
			$url_category_part = self::get_api_meta_data($category, $subcategory, $id);
			$sub_query='';
			if(count($query)){
				$sub_query.='?';
				foreach ($query as $key => $value) {
					$sub_query.=$key."=".$value."&";
				}
				$sub_query=trim($sub_query,'&');
			}
			$api_key = '&apiKey='.self::get_api_key();
			$url = $GLOBALS['configue']['API_URL'].$url_category_part.$sub_query.$api_key;
			// error_log("URL: $url");
			return self::request($url);
	}
}