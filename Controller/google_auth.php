<?php
session_start();
	require_once "google_controller_configue.php";
	require '../Model/database_crud.php';
	require '../Model/data_validation.php';
	$database_crud = new DatabaseCrud();
	$validate = new Validation();

	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: ../index.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();
	// print_r($userData);
	$_SESSION['user_detail']= array(
		'id'        => '',
		'name'      => $validate->name_set($userData['givenName']),
		'last_name' => $validate->name_set($userData['familyName']),
		'email'     => strtolower($userData['email']),
		'gender'    => $userData['gender'],
		'image_url' => $userData['picture']
		 );

		if($_SESSION['user_detail']['name']!='' && $_SESSION['user_detail']['email']!=''){
			error_log('inside first if');
			$get_value = array('email','id','first_name','last_name','gender','image_url');
			$result=$database_crud->select('registration',$get_value,'email',$database_crud->escape_string($_SESSION['user_detail']['email']));
			if($result){
				$_SESSION['user_detail']['id']=$result['id'];
			}else{
				$send_value = array(
					'email'      =>	$_SESSION['user_detail']['email'],
					'first_name' =>	$_SESSION['user_detail']['name']
				);
				if(!empty($_SESSION['user_detail']['last_name'])){
					$send_value['last_name']=$_SESSION['user_detail']['last_name'];
				}
				if(!empty($_SESSION['user_detail']['gender'])){
					$send_value['gender']=$_SESSION['user_detail']['gender'];
				}
				if(!empty($_SESSION['user_detail']['image_url'])){
					$send_value['image_url']=$_SESSION['user_detail']['image_url'];
				}
				if($database_crud->insert_and_update('registration',$send_value)){
					$result=$database_crud->select('registration',array('id'),'email',$database_crud->escape_string($_SESSION['user_detail']['email']));
					if($result){
						$_SESSION['user_detail']['id']=$result['id'];		
					}
				}
			}
		}
	header('Location: ../index.php');
?>	