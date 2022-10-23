<?php 
	session_start();
	require '../Model/database_crud.php';
	$database_crud = new DatabaseCrud();

	require '../Model/data_validation.php';
	function authentication($email,$password){
		$result=$GLOBALS['database_crud']->select('registration',$GLOBALS['database_crud']->escape_string(array('email','password')),'email',$GLOBALS['database_crud']->escape_string($email));
		if($result){
			if (password_verify($password, $result['password']) && $result['password']!='') {
				error_log('password:'.$result['password']." email:".$result['email']);
				$user_detail=$GLOBALS['database_crud']->select('registration',array('`id`','`email`','`first_name`', '`last_name`', '`gender`', '`image_url`'),'email',$GLOBALS['database_crud']->escape_string($email));
				$_SESSION['user_detail']= array(
					'id'=> $user_detail['first_name'],
					'name' => $user_detail['first_name'],
					'last_name' => $user_detail['last_name'],
					'email' => $user_detail['email'],
					'gender' => $user_detail['gender'],
					'image_url' => $user_detail['image_url']
					 );
				echo json_encode(true);				
			}else{
				echo json_encode(false);				
			}
		}else{
			echo json_encode(false);
		}
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' ){
		$validate = new Validation();	
		switch ($_POST['type']) {
			case 'login_chk':
				authentication($_POST['data']['email'],$_POST['data']['password']);
				break;
			case 'otp_match':
				echo json_encode($_POST['data']['otp']==$_SESSION['otp']);
				break;
			case 'select':
				if($validate->email_val($_POST['data']['email'])){
					$result = $GLOBALS['database_crud']->select('registration',$GLOBALS['database_crud']->escape_string($_POST['data']['select']),$GLOBALS['database_crud']->escape_string($_POST['data']['verify']),$GLOBALS['database_crud']->escape_string($_POST['data']['email']));
					echo json_encode($result);
				}else{
					echo json_encode('invalid email');
				}
				break;

			case 'insert and update':
				if($validate->email_val($_POST['data']['email']) && $validate->chk_pswd($_POST['data']['password'])){
					$_POST['data']['first_name'] = $validate->name_set($_POST['data']['first_name']);
					$_POST['data']['last_name'] = $validate->name_set($_POST['data']['last_name']);
					$_POST['data']['password'] = password_hash($_POST['data']['password'], PASSWORD_ARGON2I);
					error_log($_POST['data']['password']);
					$result = $GLOBALS['database_crud']->insert_and_update('registration',$GLOBALS['database_crud']->escape_string($_POST['data']));
					echo json_encode($result);
				}else{
					echo json_encode('data miss match');
				}
				break;

			default:
				echo "data missmatch";
		}
	}
	
 ?>