<?php
	error_reporting(0);
	require_once '../Api/api_call.php';

	function just_id_title($req){
		// error_log('in just id and title controller class');
		$Api_data = array();
		for($i=0;$i<count($req->results);$i++){
			$Api_data[$i]['id']         = $req->results[$i]->id;
			$Api_data[$i]['title']      = $req->results[$i]->title;
			// error_log($Api_data[$i]['id'].$Api_data[$i]['title']);
		}
		echo json_encode($Api_data);		
	}

	function modal($req){
		// error_log('in modal api controller class');
		// print "<pre>";print_r(count($req->recipes));
		$Api_data = array();
		for($i=0;$i<count($req->recipes);$i++){
			$Api_data[$i]['id']         = $req->recipes[$i]->id;
			$Api_data[$i]['title']      = $req->recipes[$i]->title;
			if( trim($req->recipes[$i]->image,' ') === 0){
				$Api_data[$i]['img_url']    = '../public/assets/images/default_image_when_loading.png';
			}else{
				$Api_data[$i]['img_url']    = $req->recipes[$i]->image;
			}
			$Api_data[$i]['source_url'] = $req->recipes[$i]->sourceUrl;
			$Api_data[$i]['summary']    = strip_tags($req->recipes[$i]->summary);
			// error_log($Api_data[$i]['id'].$Api_data[$i]['title']);
		}
		echo json_encode($Api_data);
	}

	function cards($req){
		$str='';
		for($i=0;$i<count($req->recipes);$i++){

			$str.='<div class="col-md-4 mb-4 wow fadeIn" data-wow-delay="0.4s">
			<!-- Card -->
			<div class="card card-cascade narrower" style="margin-top: 44px">
			<!-- Card image -->
			<div class="view view-cascade overlay">
			<img src="'.$req->recipes[$i]->image.'" class="card-img-top"
			alt="">
			<a>
			<div class="mask rgba-white-slight"></div>
			</a>
			</div>
			<!-- Card image -->

			<!-- Card content -->
			<div class="card-body card-body-cascade">
			<h5 class="pink-text"><i class="fas fa-utensils"></i> </h5>
			<!-- Title -->
			<h4 class="card-title">'.$req->recipes[$i]->title.'</h4>
			<!-- Text -->
			<p class="card-text">'.substr(strip_tags($req->recipes[$i]->summary),0,100).'</p>
			<a tarPOST="_blank" class="btn btn-unique waves-effect waves-light" onclick="detail_of_item(this)">open detail</a>
			<input type="hidden" name="id" value="'.$req->recipes[$i]->id.'">
			</div>
			<!-- Card content -->
			</div>
			<!-- Card -->
			</div>';
		}
		echo $str;
	}

	function carousel(){
	}

	function chatbot($req){
		// error_log('inside chatbot');
		// error_log($req->answerText);
		$str='<div class="d-flex justify-content-start mb-2">
                  <div class="img_cont_msg">
                    <img src="../public/assets/images/shaza.png" class="rounded-circle user_img_msg">
                  </div>
                  <div class="msg_cotainer">'.$req->answerText.'</div>
                </div>';
                error_log($str);
                for($i=0; $i < count($req->media); $i++) { 
                	$id_val=explode('-',$req->media[$i]->link);
                error_log('--------------------------');
                error_log($req->media[$i]->title.$req->media[$i]->image.$id_val[count($id_val)-1]);
                	$str.='<div class="d-flex justify-content-start mb-2">
                  <div class="msg_cotainer text-center"><b>'.$req->media[$i]->title.'</b><div class="msg_cotainer"><img style="width: 100%;" src="'.$req->media[$i]->image.'"></div>
                  </div>
                  	<input type="hidden" name="id" value="'.$id_val[count($id_val)-1].'">       
                </div>';
                // error_log('--------------------------');
                // error_log($str);
                }
                // error_log('--------------------------');
                // error_log($str);
        echo $str;               
	}

	function just_data($req){
        echo json_encode($req);                     
	}
	
	function new_page($req){
		session_start();
		$_SESSION['data']=$req;
		// header('location:shubham_code_detail_page.php');                     
        echo json_encode($req);                     
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST' ){

		$obj = new ApiCall();
		$request='';
	
		if(isset($_POST['id'])){
			$request = $obj->api_call($_POST['category'],$_POST['sub_category'],$_POST['query'],
				$_POST['rand'],$_POST['id']);
		}else {
			$request = $obj->api_call($_POST['category'],$_POST['sub_category'],$_POST['query'],$_POST['rand']);
		}
		// error_log('Got response');

		switch ($_POST['type']) {				
			case 'modal':
				modal(json_decode($request));
				break;
	
			case 'id_title':
				just_id_title(json_decode($request));
				break;

			case 'cards':
				cards(json_decode($request));
				break;

			case 'chatbot':
				chatbot(json_decode($request));
				break;

			case 'carousel':
				carousel(json_decode($request));
				break;

			case 'just_data':
				just_data(json_decode($request));
				break;

			case 'new_page':
				new_page(json_decode($request));
				break;

			default:
				echo "data missmatch";
				break;
		}
		// error_log(" Data is sent");
	}
?>